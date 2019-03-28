<?php
/**
 * Provide aliases for zend-stratigilty v3 functions.
 *
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Stratigility;

use Laminas\Stratigility\Middleware\CallableMiddlewareDecorator;
use Laminas\Stratigility\Middleware\DoublePassMiddlewareDecorator;
use Laminas\Stratigility\Middleware\HostMiddlewareDecorator;
use Laminas\Stratigility\Middleware\PathMiddlewareDecorator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

use function Laminas\Stratigility\doublePassMiddleware as laminasDoublePassMiddleware;
use function Laminas\Stratigility\host as laminasHost;
use function Laminas\Stratigility\middleware as laminasMiddleware;
use function Laminas\Stratigility\path as laminasPath;

function doublePassMiddleware(
    callable $middleware,
    ResponseInterface $response = null
) : DoublePassMiddlewareDecorator {
    return laminasDoublePassMiddleware($middleware, $response);
}

function host(string $host, MiddlewareInterface $middleware) : HostMiddlewareDecorator
{
    return laminasHost($host, $middleware);
}

function middleware(callable $middleware) : CallableMiddlewareDecorator
{
    return laminasMiddleware($middleware);
}

function path(string $path, MiddlewareInterface $middleware) : PathMiddlewareDecorator
{
    return laminasPath($path, $middleware);
}
