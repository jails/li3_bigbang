<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace admin\controllers;

use lithium\net\http\Router;

class HelloWorldController extends \lithium\action\Controller {

	public function index() {
		return $this->render(['layout' => false]);
	}

	public function to_string() {
		return "Hello Admin World";
	}

	public function to_json() {
		return $this->render(['json' => 'Hello Admin World']);
	}

}

?>