<?php

return [
    'service_manager' => [
        'abstract_factories' => [
            'Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory',
        ],
        'aliases' => [
            'Zend\Cache\Storage\StorageInterface' => 'Zend\Cache\Storage\Adapter\Redis',
        ],
        'delegators' => [
            'Zend\Cache\Storage\Adapter\Redis' => [
                'Zend\ServiceManager\Proxy\LazyServiceFactory',
            ],
        ],
        'factories' => [
            'Zend\Form\Factory' => 'Some\Vendor\Zend\Form\ZendFormFactory',
            'MyService' => 'Zend\ServiceManager\Factory\InvokableFactory',
        ],
        'initializers' => [
            // Just for testing purposes, this initializer does not exist
            'Zend\Form\FactoryInitializer',
        ],
        'invokables' => [
            'Zend\Expressive\Router\RouterInterface' => 'MyService',
        ],
        'lazy_services' => [
            'class_map' => [
                'Zend\Cache\Storage\Adapter\Redis' => 'Zend\Cache\Storage\Adapter\Redis',
            ],
        ],
        'services' => [
            // NOTE: this is an invalid configuration, you have to provide service instances in this array.
            // For testing purposes, we have to change this to a string we can use to verify that the value
            // is not touched at all. Using instances would lead to
            'Zend\Cache\Storage\Adapter\Redis' => 'Zend\Cache\Storage\Adapter\Redis',
        ],
        'shared' => [
            'Zend\Form\Factory' => false,
        ],
    ],
];
