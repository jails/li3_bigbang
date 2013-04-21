<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace test;

use lithium\core\Libraries;
use lithium\test\Group;
use lithium\util\Set;
use lithium\net\http\Router;
use lithium\net\http\Media;
use test\Dispatcher;
/**
 * The Test Controller for running the html version of the test suite
 *
 */
class Controller extends \lithium\core\Object {

	/**
	 * Saved context.
	 *
	 * @var array
	 */
	protected $_context = array();

	/**
	 * Magic method to make Controller callable.
	 *
	 * @see lithium\action\Dispatcher::_callable()
	 * @param object $request A \lithium\action\Request object.
	 * @param array $dispatchParams Array of params after being parsed by router.
	 * @param array $options Some basic options for this controller.
	 * @return string
	 * @filter
	 */
	public function __invoke($request, $dispatchParams, array $options = array()) {
		$dispatchParamsDefaults = array('args' => array());
		$dispatchParams += $dispatchParamsDefaults;
		$defaults = array('format' => 'html', 'timeout' => 0);
		$options += (array) $request->query + $defaults;
		$params = compact('request', 'dispatchParams', 'options');

		return $this->_filter(__METHOD__, $params, function($self, $params) {
			$request = $params['request'];
			$options = $params['options'];
			$params = $params['dispatchParams'];
			set_time_limit((integer) $options['timeout']);
			$group = join('\\', (array) $params['args']);

			if ($group === "all") {
				$group = Group::all();
				$options['title'] = 'All Tests';
			}

			$report = $this->_runTests($group, $options);

			$filters = Libraries::locate('test.filter');

			if (isset($request->query['library'])) {
				$library = $request->query['library'];
			} else {
				$library = 'lithium';
			}
			$menu = $this->_buildMenu($library);

			$baseUrl = Router::match('/', $request);
			$basePath = Media::asset('/', null, array(
				'base' => $request->env('base'),
				'scope' => 'test'
			));
			$commonPath = Media::asset('/', null, array(
				'base' => $request->env('base'),
				'scope' => 'commons'
			));

			$libraries = $this->_buildLibraryMenu();

			$result = compact(
				'request', 'report', 'filters', 'library', 'libraries',
				'menu', 'baseUrl', 'basePath', 'commonPath'
			);
			return $report->render('layout', $result);
		});
	}

	protected function _runTests($group, $options) {
		$scopes = array('test', 'commons');
		$medias = Media::attached();
		$media = Media::scope();
		Media::reset();

		$this->_saveCtrlContext();
		$report = Dispatcher::run($group, $options);
		$this->_restoreCtrlContext();

		foreach($medias as $name => $config) {
			Media::attach($name, $config);
		}
		Media::scope($media);
		return $report;
	}

	protected function _buildLibraryMenu() {
		$libraries = array();
		$options = array(
			'recursive' => true,
			'filter' => '/tests\\\.*Test/',
			'exclude' => '/tests\\\(mocks)/',
		);
		foreach(Libraries::get() as $lib) {
			if((!isset($lib['test']) || $lib['test']) && $lib['name'] != 'test')  {
				if(Libraries::find($lib['name'], $options)) {
					$libraries[] = $lib['name'];
				}
			}
		}
		return array_reverse($libraries);
	}

	protected function _buildMenu($library) {
		$menu = array();
		$options = array(
			'recursive' => true,
			'filter' => '/tests\\\.*Test/',
			'exclude' => '/tests\\\(mocks)/',
		);
		$menu = array_merge($menu, Libraries::find($library, $options));
		$menu = array_unique($menu);
		sort($menu);
		return $menu;
	}

	protected function _saveCtrlContext() {
		$this->_context['scope'] = Router::scope(false);
		$this->_context['routes'] = Router::get();
		$this->_context['scopes'] = Router::attached();
		Router::reset();
	}

	protected function _restoreCtrlContext() {
		Router::reset();
		foreach ($this->_context['routes'] as $scope => $routes) {
			Router::scope($scope, function() use ($routes) {
				foreach ($routes as $route) {
					Router::connect($route);
				}
			});
		}
		foreach ($this->_context['scopes'] as $scope => $attachment) {
			Router::attach($scope, $attachment);
		}
		Router::scope($this->_context['scope']);
	}
}

?>