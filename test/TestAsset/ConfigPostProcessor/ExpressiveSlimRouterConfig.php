<?php
namespace Acelaya\Expressive;

use Zend\Expressive\Router\RouterInterface;

return [
    'dependencies' => [
        'factories' => [
            RouterInterface::class => Factory\SlimRouterFactory::class,
        ],
    ],
];
