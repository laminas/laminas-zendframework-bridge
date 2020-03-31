<?php

return [
    'dependencies' => [
        'factories' => [
            'Buzzer' => 'Zend\ServiceManager\Factory\InvokableFactory',
        ],
        'delegators' => [
            'Buzzer' => [
                'Zend\ServiceManager\Proxy\LazyServiceFactory',
            ],
            'Zend\Db\Adapter' => [
                'Zend\ServiceManager\Proxy\LazyServiceFactory',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Buzzer' => 'Zend\ServiceManager\Factory\InvokableFactory',
        ],
        'delegators' => [
            'Buzzer' => [
                'Zend\ServiceManager\Proxy\LazyServiceFactory',
            ],
            'Zend\Db\Adapter' => [
                'Zend\ServiceManager\Proxy\LazyServiceFactory',
            ],
        ],
    ],
];
