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
            'Zend\Expressive\Router\RouterInterface' => 'MyService',
            'Zend\Expressive\OtherInterface' => 'OtherService',
            'OtherService' => 'Mezzio\OtherInterface',
            'MyAlias' => 'Zend\Expressive\AliasChain',
            'Mezzio\TwoInterface' => 'middle-alias',
            'middle-alias' => 'Zend\Expressive\TwoInterface',
        ],
        'invokables' => [
            'Zend\Expressive\AliasInterface' => 'MyNamespace\InvokableClass',
            'Zend\Expressive\AliasChain' => 'MyNamespace\OtherInvokableClass',
            'Zend\Expressive\TwoInterface' => 'MyNamespace\TwoInvokableClass',
        ],
    ],
];
