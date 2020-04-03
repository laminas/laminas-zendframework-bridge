<?php

return [
    'service_manager' => [
        'aliases' => [
            'MyAlias' => 'MyOtherService',
        ],
        'factories' => [
            'MyOtherService', 'MyOtherFactory',
            'MyOtherService' => 'MyOtherFactory',
        ],
        'invokables' => [
            'Foo', 'Bar',
            'Foo' => 'Bar',
        ],
        'services' => [
            'Invalid',
        ],
    ],
];
