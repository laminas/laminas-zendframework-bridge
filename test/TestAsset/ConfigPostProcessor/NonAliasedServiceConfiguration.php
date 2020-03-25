<?php
return [
    'dependencies' => [
        'factories' => [
            'Zend\Form\Factory' => 'Some\Vendor\Zend\Form\Factory',
        ],
        'aliases' => [
            'foo' => 'Zend\Form\Factory',
        ],
    ],
];
