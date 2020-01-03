<?php
namespace Mwop\App;

return array(
    'dependencies'            => array(
        'invokables' => array(
           'Mwop\App\Middleware\RedirectsMiddleware'       => 'Mwop\App\Middleware\RedirectsMiddleware',
           'Mwop\App\Middleware\XClacksOverheadMiddleware' => 'Mwop\App\Middleware\XClacksOverheadMiddleware',
           'Mwop\App\Middleware\XPoweredByMiddleware'      => 'Mwop\App\Middleware\XPoweredByMiddleware',
           'Psr\Http\Message\RequestFactoryInterface'      => 'Zend\Diactoros\RequestFactory',
           'Psr\Http\Message\ResponseFactoryInterface'     => 'Zend\Diactoros\ResponseFactory',
		),
        'factories' => array(
            'config-cache'                   => 'Phly\Expressive\ConfigFactory',
            'config-content-security-policy' => 'Phly\Expressive\ConfigFactory',
            'config-homepage'                => 'Phly\Expressive\ConfigFactory',
            'config-homepage.posts'          => 'Phly\Expressive\ConfigFactory',
            'config-instagram.feed'          => 'Phly\Expressive\ConfigFactory',
            'config-mail.transport'          => 'Phly\Expressive\ConfigFactory',

			'Middlewares\Csp'                              => 'Mwop\App\Middleware\ContentSecurityPolicyMiddlewareFactory',
			'Psr\Cache\CacheItemPoolInterface'             => 'Mwop\App\Factory\CachePoolFactory',
            'Psr\EventDispatcher\EventDispatcherInterface' => 'Mwop\App\Factory\EventDispatcherFactory',

            'Zend\Feed\Reader\Http\ClientInterface' => 'Mwop\App\Feed\HttpPlugClientFactory',
            'Mwop\App\Handler\ComicsPageHandler'    => 'Mwop\App\Handler\ComicsPageHandlerFactory',
            'Mwop\App\Handler\HomePageHandler'      => 'Mwop\App\Handler\HomePageHandlerFactory',
            'Mwop\App\Handler\ResumePageHandler'    => 'Mwop\App\Handler\PageHandlerFactory',
            'mail.transport'                        => 'Mwop\App\Factory\MailTransport',

            'Mwop\App\Middleware\RedirectAmpPagesMiddleware' 	   => 'Mwop\App\Middleware\RedirectAmpPagesMiddlewareFactory',
            'Mwop\App\SessionCachePool'               		 	   => 'Mwop\App\SessionCachePoolFactory',
		),
        'delegators' => array(
            'Mwop\Blog\Handler\DisplayPostHandler' => array(
                'Mwop\App\Middleware\DisplayBlogPostHandlerDelegator',
			),
			'League\Plates\Engine' => array(
                'Mwop\App\Factory\PlatesFunctionsDelegator',
			),
		),
	),
    'homepage' => array(
        'feed-count' => 10,
        'feeds' => array(
            array(
                'url' => 'https://framework.zend.com/blog/feed-rss.xml',
                'favicon' => 'https://framework.zend.com/ico/favicon.ico',
                'sitename' => 'Zend Framework Blog',
                'siteurl' => 'https://framework.zend.com/blog/',
			),
		),
        'posts' => array(),
	),
    'zend-expressive' => array(
        'error_handler' => array(
            'template_404'   => 'error::404',
            'template_error' => 'error::500',
		),
	),
    'zend-expressive-session-cache' => array(
        'cache_item_pool_service' => 'Mwop\App\SessionCachePool',
        'cookie_name' => 'MWOPSESS',
        'cache_limiter' => 'nocache',
        'cache_expire' => 60 * 60 * 24 * 28, // 28 days
        'persistent' => true,
	),
    'zend-expressive-swoole' => array(
        'enable_coroutine' => true,
        'swoole-http-server' => array(
            'process-name' => 'mwopnet',
            'host'         => '0.0.0.0',
            'port'         => 9000,
            // Using string value instead of constant to prevent testing errors
            'mode'         => 'SWOOLE_PROCESS',
            'options'      => array(
                'max_conn' => 1024,
                'task_worker_num' => 4,
			),
            'static-files' => array(
                'type-map' => array(
                    'asc' => 'application/octet-stream',
				),
                'gzip' => array(
                    'level' => 6,
				),
                'directives' => array(
                    '/\.(?:ico|png|gif|jpg|jpeg)$/' => array(
                        'cache-control' => array('public', 'max-age=' . 60 * 60 * 24 * 365),
                        'last-modified' => true,
                        'etag' => true,
					),
                    '/\.(?:asc)$/' => array(
                        'cache-control' => array('public', 'max-age=' . 60 * 60 * 24 * 365),
                        'last-modified' => true,
					),
                    '/\.(?:css|js)$/' => array(
                        'cache-control' => array('public', 'max-age=' . 60 * 60 * 24 * 30),
                        'last-modified' => true,
                        'etag' => true,
					),
				),

			),
		),
	),
);
