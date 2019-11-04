<?php

return [
    'dependencies' => [
        'aliases' => [
            'Zend\Db\Adapter\Adapter' => 'Laminas\Db\Adapter\Adapter',
            'Zend\Db\Adapter\Adapter' => 'ZF\Apigility\DbConnectedAdapter',
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'Zend\Db\Adapter\Adapter' => 'Laminas\Db\Adapter\Adapter',
        ],
    ],
    'validators' => [
        'aliases' => [
            'Zend\Validator\Db\Exists' => 'Laminas\Validator\Db\Exists',
        ],
    ],
];
