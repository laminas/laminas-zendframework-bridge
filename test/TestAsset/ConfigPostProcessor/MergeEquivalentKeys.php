<?php
return [
    // Test merging array with scalar
    'zf-rest' => [
        [
            'name' => 'Some\Rest\Controller',
        ],
    ],
    'apigility-rest' => 'Some\Other\Rest\Controller',

    // Test merging null with array
    'zend-expressive' => null,
    'expressive' => [
        'error_handler' => [
            'template_404' => 'custom::404',
            'template_error' => 'custom::500',
        ],
    ],

    // Test merging null with scalar
    'zend-expressive-hal' => null,
    'expressive-hal' => 'some-value',

    // Test merging scalar with null
    'zf-content-negotiation' => 'some-value',
    'apigility-content-negotiation' => null,

    // Test merging array with null
    'zend-expressive-swoole' => [
        'swoole-http-server' => [
        ],
    ],
    'expressive-swoole' => null,

    // Test merging scalar with array
    'zend-expressive-tooling' => 'string value',
    'expressive-tooling' => [
        'some' => 'value',
    ],

    // Test merging two scalars
    'zend-expressive-authorization' => 'string value',
    'expressive-authorization' => 2.0,
];
