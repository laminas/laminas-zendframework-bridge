<?php

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\Proxy\LazyServiceFactory;

return [
    'dependencies' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory',
        ],
        'lazy_services' => [
            // Mapping services to their class names is required
            // since the ServiceManager is not a declarative DIC.
            'class_map' => [
                'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\Adapter',
            ],
        ],
        'delegators' => [
            'Zend\Db\Adapter\Adapter' => [
                LazyServiceFactory::class,
            ],
        ],
    ],
];
