<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use lithium\net\http\Router;

Router::scope('test', function() {
	Router::connect('/test/{:args}', array('controller' => 'test\Controller'));
	Router::connect('/test', array('controller' => 'test\Controller'));
});

?>