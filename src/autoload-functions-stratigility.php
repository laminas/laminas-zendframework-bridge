<?php
/**
 * Provide aliases for zend-stratigilty functions.
 *
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Stratigility;

use Laminas\Stratigility\Middleware\CallableMiddlewareDecorator;
use Psr\Http\Server\MiddlewareInterface;
use Webimpress\HttpMiddlewareCompatibility;

// Only define functions if one or more known functions do not exist
// and a known class is present.
if (! function_exists(__NAMESPACE__ . '\middleware') && class_exists(CallableMiddlewareDecorator::class)) {
    if (interface_exists(MiddlewareInterface::class)) {
        require __DIR__ . '/autoload-functions-stratigility-v3.php';
    } elseif (interface_exists(HttpMiddlewareCompatibility\MiddlewareInterface::class)) {
        require __DIR__ . '/autoload-functions-stratigility-v2.php';
    }
}
