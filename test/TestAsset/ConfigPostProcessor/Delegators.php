<?php

return [
    'dependencies' => [
        'delegators' => [
            'Buzzer' => [
                '\Zend\ServiceManager\Proxy\LazyServiceFactory',
            ],
        ],
    ],
    'service_manager' => [
        'delegators' => [
            'Buzzer' => [
                '\Zend\ServiceManager\Proxy\LazyServiceFactory',
            ],
        ],
    ],
];
