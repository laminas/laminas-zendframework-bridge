<?php
namespace Acelaya\Expressive;

return array(
    'dependencies' => array(
        'factories' => array(
            'Zend\Expressive\Router\RouterInterface' => 'Acelaya\Expressive\Factory\SlimRouterFactory',
        ),
    ),
);
