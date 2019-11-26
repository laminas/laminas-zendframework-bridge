<?php
return [
    // Test merging array with scalar
    'zf-rest' => [
        [
            'name' => 'Some\Rest\Controller',
        ],
    ],
    'api-tools-rest' => 'Some\Other\Rest\Controller',

    // Test merging null with array
    'zend-expressive' => null,
    'mezzio' => [
        'error_handler' => [
            'template_404' => 'custom::404',
            'template_error' => 'custom::500',
        ],
    ],

    // Test merging null with scalar
    'zend-expressive-hal' => null,
    'mezzio-hal' => 'some-value',

    // Test merging scalar with null
    'zf-content-negotiation' => 'some-value',
    'api-tools-content-negotiation' => null,

    // Test merging array with null
    'zend-expressive-swoole' => [
        'swoole-http-server' => [
        ],
    ],
    'mezzio-swoole' => null,

    // Test merging scalar with array
    'zend-expressive-tooling' => 'string value',
    'mezzio-tooling' => [
        'some' => 'value',
    ],

    // Test merging two scalars
    'zend-expressive-authorization' => 'string value',
    'mezzio-authorization' => 2.0,
];
