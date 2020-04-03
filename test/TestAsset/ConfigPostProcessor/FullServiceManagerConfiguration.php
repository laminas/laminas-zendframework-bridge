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
            'Zend\Cache\Storage\Adapter\RedisOptions' => [
                'server' => [
                    'host' => 'localhost',
                    'port' => 6379,
                    'timeout' => 0,
                ],
            ],
            'preferred-cache-storage' => [
                'name' => 'Zend\Cache\Storage\Adapter\Redis',
                'options' => 'Zend\Cache\Storage\Adapter\RedisOptions',
            ],
        ],
        'shared' => [
            'Zend\Form\Factory' => false,
        ],
        'sharedByDefault' => false,
    ],
];
