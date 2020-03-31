<?php

use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            'MyService' => InvokableFactory::class,
        ],
        'abstract_factories' => [
            ConfigAbstractFactory::class,
            'Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory',
        ],
    ],

    'dependencies' => [
        'factories' => [
            'MyService' => InvokableFactory::class,
        ],
        'abstract_factories' => [
            ConfigAbstractFactory::class,
            'Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory',
        ],
    ],
];
