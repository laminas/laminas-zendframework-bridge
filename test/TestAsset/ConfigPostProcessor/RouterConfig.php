<?php
return array(
    'router' => array(
        'routes' => array(
            'zf-apigility' => array(
                'child_routes' => array(
                    'custom' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/custom',
                            'defaults' => array(
                                'controller' => 'My\Custom\Controller',
                                'action' => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
