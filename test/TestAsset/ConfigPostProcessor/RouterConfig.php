<?php
return [
    'router' => [
        'routes' => [
            'zf-apigility' => [
                'child_routes' => [
                    'custom' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/custom',
                            'defaults' => [
                                'controller' => 'My\Custom\Controller',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
