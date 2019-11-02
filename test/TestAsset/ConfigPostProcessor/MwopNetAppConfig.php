<?php
namespace Mwop\App;

use League\Plates\Engine;
use Middlewares\Csp;
use Mwop\Blog\Handler\DisplayPostHandler;
use Phly\Expressive\ConfigFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Zend\Diactoros\RequestFactory;
use Zend\Diactoros\ResponseFactory;
use Zend\Expressive\Application;
use Zend\Expressive\Session\SessionMiddleware;
use Zend\Feed\Reader\Http\ClientInterface as FeedReaderHttpClientInterface;

return [
    'dependencies'            => [
        'invokables' => [
            Middleware\RedirectsMiddleware::class       => Middleware\RedirectsMiddleware::class,
            Middleware\XClacksOverheadMiddleware::class => Middleware\XClacksOverheadMiddleware::class,
            Middleware\XPoweredByMiddleware::class      => Middleware\XPoweredByMiddleware::class,
            RequestFactoryInterface::class              => RequestFactory::class,
            ResponseFactoryInterface::class             => ResponseFactory::class,
        ],
        'factories' => [
            'config-cache'                               => ConfigFactory::class,
            'config-content-security-policy'             => ConfigFactory::class,
            'config-homepage'                            => ConfigFactory::class,
            'config-homepage.posts'                      => ConfigFactory::class,
            'config-instagram.feed'                      => ConfigFactory::class,
            'config-mail.transport'                      => ConfigFactory::class,
            Csp::class                                   => Middleware\ContentSecurityPolicyMiddlewareFactory::class,
            CacheItemPoolInterface::class                => Factory\CachePoolFactory::class,
            EventDispatcherInterface::class              => Factory\EventDispatcherFactory::class,
            FeedReaderHttpClientInterface::class         => Feed\HttpPlugClientFactory::class,
            Handler\ComicsPageHandler::class             => Handler\ComicsPageHandlerFactory::class,
            Handler\HomePageHandler::class               => Handler\HomePageHandlerFactory::class,
            Handler\ResumePageHandler::class             => Handler\PageHandlerFactory::class,
            Handler\ResumePageHandler::class             => Handler\PageHandlerFactory::class,
            'mail.transport'                             => Factory\MailTransport::class,
            Middleware\RedirectAmpPagesMiddleware::class => Middleware\RedirectAmpPagesMiddlewareFactory::class,
            SessionCachePool::class                      => SessionCachePoolFactory::class,
        ],
        'delegators' => [
            DisplayPostHandler::class => [
                Middleware\DisplayBlogPostHandlerDelegator::class,
            ],
            Engine::class => [
                Factory\PlatesFunctionsDelegator::class,
            ],
        ],
    ],
    'homepage' => [
        'feed-count' => 10,
        'feeds' => [
            [
                'url' => 'https://framework.zend.com/blog/feed-rss.xml',
                'favicon' => 'https://framework.zend.com/ico/favicon.ico',
                'sitename' => 'Zend Framework Blog',
                'siteurl' => 'https://framework.zend.com/blog/',
            ],
        ],
        'posts' => [],
    ],
    'zend-expressive' => [
        'error_handler' => [
            'template_404'   => 'error::404',
            'template_error' => 'error::500',
        ],
    ],
    'zend-expressive-session-cache' => [
        'cache_item_pool_service' => SessionCachePool::class,
        'cookie_name' => 'MWOPSESS',
        'cache_limiter' => 'nocache',
        'cache_expire' => 60 * 60 * 24 * 28, // 28 days
        'persistent' => true,
    ],
    'zend-expressive-swoole' => [
        'enable_coroutine' => true,
        'swoole-http-server' => [
            'process-name' => 'mwopnet',
            'host'         => '0.0.0.0',
            'port'         => 9000,
            // Using string value instead of constant to prevent testing errors
            'mode'         => 'SWOOLE_PROCESS',
            'options'      => [
                'max_conn' => 1024,
                'task_worker_num' => 4,
            ],
            'static-files' => [
                'type-map' => [
                    'asc' => 'application/octet-stream',
                ],
                'gzip' => [
                    'level' => 6,
                ],
                'directives' => [
                    '/\.(?:ico|png|gif|jpg|jpeg)$/' => [
                        'cache-control' => ['public', 'max-age=' . 60 * 60 * 24 * 365],
                        'last-modified' => true,
                        'etag' => true,
                    ],
                    '/\.(?:asc)$/' => [
                        'cache-control' => ['public', 'max-age=' . 60 * 60 * 24 * 365],
                        'last-modified' => true,
                    ],
                    '/\.(?:css|js)$/' => [
                        'cache-control' => ['public', 'max-age=' . 60 * 60 * 24 * 30],
                        'last-modified' => true,
                        'etag' => true,
                    ],
                ],

            ],
        ],
    ],
];
