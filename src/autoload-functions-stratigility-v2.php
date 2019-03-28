<?php
/**
 * Provide aliases for zend-stratigilty v2 functions.
 *
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Stratigility;

use Laminas\Stratigility\Middleware\CallableMiddlewareDecorator;
use Laminas\Stratigility\Middleware\DoublePassMiddlewareDecorator;
use Laminas\Stratigility\Middleware\PathMiddlewareDecorator;
use Psr\Http\Message\ResponseInterface;
use Webimpress\HttpMiddlewareCompatibility;

use function Laminas\Stratigility\doublePassMiddleware as laminasDoublePassMiddleware;
use function Laminas\Stratigility\middleware as laminasMiddleware;
use function Laminas\Stratigility\path as laminasPath;

/**
 * @return DoublePassMiddlewareDecorator
 */
function doublePassMiddleware(callable $middleware, ResponseInterface $response = null)
{
    return laminasDoublePassMiddleware($middleware, $response);
}

/**
 * @return CallableMiddlewareDecorator
 */
function middleware(callable $middleware)
{
    return laminasMiddleware($middleware);
}

/**
 * @param string $path
 * @return PathMiddlewareDecorator
 */
function path(
    $path,
    HttpMiddlewareCompatibility\MiddlewareInterface $middleware
) {
    return laminasPath($path, $middleware);
}
