<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use lithium\action\Request;
use lithium\action\Dispatcher;
use lithium\core\Environment;
/**
 * This is the primary bootstrap file of your application, and is loaded immediately after the front
 * controller (`webroot/index.php`) is invoked. It includes references to other feature-specific
 * bootstrap files that you can turn on and off to configure the services needed for your
 * application.
 *
 * Besides global configuration of external application resources, these files also include
 * configuration for various classes to interact with one another, usually through _filters_.
 * Filters are Lithium's system of creating interactions between classes without tight coupling. See
 * the `Filters` class for more information.
 *
 * If you have other services that must be configured globally for the entire application, create a
 * new bootstrap file and `require` it here.
 *
 * @see lithium\util\collection\Filters
 */

/**
 * The libraries file contains the loading instructions for all plugins, frameworks and other class
 * libraries used in the application, including the Lithium core, and the application itself. These
 * instructions include library names, paths to files, and any applicable class-loading rules. This
 * file also statically loads common classes to improve bootstrap performance.
 */
require __DIR__ . '/bootstrap/libraries.php';

/**
 * The following will instantiate a new `Request` object and initialize the `Environment` class.
 * By default, the `Request` will automatically aggregate all the server / environment settings, URL
 * and query string parameters, request content (i.e. POST or PUT data), and HTTP method and header
 * information.
 */
$request = new lithium\action\Request();
Environment::set($request);

/**
 * The error configuration allows you to use the filter system along with the advanced matching
 * rules of the `ErrorHandler` class to provide a high level of control over managing exceptions in
 * your application, with no impact on framework or application code.
 */
//require __DIR__ . '/bootstrap/errors.php';

/**
 * This file contains configurations for connecting to external caching resources, as well as
 * default caching rules for various systems within your application
 */
//require __DIR__ . '/bootstrap/cache.php';

/**
 * Include this file if your application uses one or more database connections.
 */
require __DIR__ . '/bootstrap/connections.php';

/**
 * This file defines bindings between classes which are triggered during the request cycle, and
 * allow the framework to automatically configure its environmental settings. You can add your own
 * behavior and modify the dispatch cycle to suit your needs.
 */
require __DIR__ . '/bootstrap/action.php';

/**
 * This file contains configuration for session (and/or cookie) storage, and user or web service
 * authentication.
 */
// require __DIR__ . '/bootstrap/session.php';

/**
 * This file contains your application's globalization rules, including inflections,
 * transliterations, localized validation, and how localized text should be loaded. Uncomment this
 * line if you plan to globalize your site.
 */
// require __DIR__ . '/bootstrap/g11n.php';

/**
 * This file contains configurations for handling different content types within the framework,
 * including converting data to and from different formats, and handling static media assets.
 */
require __DIR__ . '/bootstrap/media.php';

/**
 * This file contains libraries attachments
 */
require __DIR__ . '/bootstrap/attachments.php';

/**
 * This file configures console filters and settings, specifically output behavior and coloring.
 */
// require __DIR__ . '/bootstrap/console.php';

/**
 * This file configures xhprof.
 */
// require __DIR__ . '/bootstrap/xhprof.php';

/**
 * The `Request` is passed to the `Dispatcher` (in conjunction with the `Router`) to determine
 * the correct `Controller` object to dispatch to, and the correct response type to render. The
 * response information is then encapsulated in a `Response` object, which is returned from the
 * controller to the `Dispatcher`, and finally echoed below. Echoing a `Response` object causes its
 * headers to be written, and its response body to be written in a buffer loop.
 *
 * @see lithium\action\Request
 * @see lithium\action\Response
 * @see lithium\action\Dispatcher
 * @see lithium\net\http\Router
 * @see lithium\action\Controller
 */
echo Dispatcher::run($request);
?>
