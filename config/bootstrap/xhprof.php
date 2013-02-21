<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */


use lithium\action\Dispatcher;

Dispatcher::applyFilter('run', function($self, $params, $chain) {
	xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
	$data = $chain->next($self, $params, $chain);
	$xhprof_data = xhprof_disable();
	$XHPROF_ROOT = '/var/www/xhprof';
	include($XHPROF_ROOT . '/xhprof_lib/config.php');

	if (!defined('XHPROF_LIB_ROOT')) {
		define('XHPROF_LIB_ROOT', $XHPROF_ROOT . '/xhprof_lib');
	}
	global $_xhprof;
	$_xhprof['savepost'] = true;
	$profiler_namespace = 'app';
	include_once $XHPROF_ROOT . '/xhprof_lib/utils/xhprof_lib.php';
	include_once $XHPROF_ROOT . '/xhprof_lib/utils/xhprof_runs.php';

	$xhprof_runs = new XHProfRuns_Default();
	$xhprof_runs->save_run($xhprof_data, $profiler_namespace, null, $_xhprof);
	return $data;
});

?>