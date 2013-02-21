<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * The `Collection` class, which serves as the base class for some of Lithium's data objects
 * (`RecordSet` and `Document`) provides a way to manage data collections in a very flexible and
 * intuitive way, using closures and SPL interfaces. The `to()` method allows a `Collection` (or
 * subclass) to be converted to another format, such as an array. The `Collection` class also allows
 * other classes to be connected as handlers to convert `Collection` objects to other formats.
 *
 * The following connects the `Media` class as a format handler, which allows `Collection`s to be
 * exported to any format with a handler provided by `Media`, i.e. JSON. This enables things like
 * the following:
 * {{{
 * $posts = Post::find('all');
 * return $posts->to('json');
 * }}}
 */
use lithium\action\Dispatcher;
use lithium\net\http\Router;
use lithium\net\http\Media;
use lithium\util\Collection;

Collection::formats('lithium\net\http\Media');

Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
	$scope = Router::scope();
	if (Media::attached($scope)) {
		Media::scope($scope);
	}
	return $chain->next($self, $params, $chain);
});

?>