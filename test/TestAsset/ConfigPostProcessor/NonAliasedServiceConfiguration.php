<?php
return [
    'dependencies' => [
        'factories' => [
            'some-alias' => 'Some\Vendor\Acl\ZendAcl',
            'Zend\Form\Factory' => 'Some\Vendor\Zend\Form\ZendFormFactory',
            'Zend\Cache\Storage\StorageInterface' => 'Zend\ServiceManager\Factory\InvokableFactory',
        ],
        'aliases' => [
            'foo' => 'Zend\Form\Factory',
            'Zend\Cache\Storage\StorageInterface' => 'Laminas\Cache\Storage\StorageInterface',
        ],
    ],
];
