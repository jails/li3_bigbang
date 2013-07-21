<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use lithium\net\http\Router;
use lithium\net\http\Media;

/**
 * Default application attachment
 *
 * Warning : an empty prefix like bellow mean it matches any prefix this mean the libraries
 * attached to this kind of rule must be included last (i.e in the boostrap `libraries.php` file)
 * for having its routes exectuted last otherwise it'll be always match.
 */
Router::attach('app', ['prefix' => '']);
Media::attach('app', ['prefix' => 'apps/app']);

/**
 * Admin application attachment which use the same media as the default application.
 */
Router::attach('admin', ['prefix' => 'admin']);
Media::attach('admin', ['prefix' => 'apps/app']);

/**
 * Test application
 */
Router::attach('test', ['prefix' => '']);
Media::attach('test', ['prefix' => 'apps/test']);

/**
 * Common assets
 */
Media::attach('commons', ['prefix' => 'commons']);
?>