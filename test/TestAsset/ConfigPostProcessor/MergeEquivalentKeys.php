<?php
return [
    'zf-rest' => [
        [
            'name' => 'Some\Rest\Controller',
        ],
    ],
    'zend-expressive' => null,
    'expressive' => [
        'error_handler' => [
            'template_404' => 'custom::404',
            'template_error' => 'custom::500',
        ],
    ],
    'apigility-rest' => 'Some\Other\Rest\Controller',
];
