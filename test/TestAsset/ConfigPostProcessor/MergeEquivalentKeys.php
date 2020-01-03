<?php
return array(
    // Test merging array with scalar
    'zf-rest' => array(
        array(
            'name' => 'Some\Rest\Controller',
		),
	),
    'api-tools-rest' => 'Some\Other\Rest\Controller',

    // Test merging null with array
    'zend-expressive' => null,
    'mezzio' => array(
        'error_handler' => array(
            'template_404' => 'custom::404',
            'template_error' => 'custom::500',
		),
	),

    // Test merging null with scalar
    'zend-expressive-hal' => null,
    'mezzio-hal' => 'some-value',

    // Test merging scalar with null
    'zf-content-negotiation' => 'some-value',
    'api-tools-content-negotiation' => null,

    // Test merging array with null
    'zend-expressive-swoole' => array(
        'swoole-http-server' => array(),
	),
    'mezzio-swoole' => null,

    // Test merging scalar with array
    'zend-expressive-tooling' => 'string value',
    'mezzio-tooling' => array(
        'some' => 'value',
	),

    // Test merging two scalars
    'zend-expressive-authorization' => 'string value',
    'mezzio-authorization' => 2.0,
);
