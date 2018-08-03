<?php
return [
    'controllers' => [
        'factories' => [
            'Email\\V1\\Rpc\\Email\\Controller' => \Email\V1\Rpc\Email\EmailControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'email.rpc.email' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/send-email',
                    'defaults' => [
                        'controller' => 'Email\\V1\\Rpc\\Email\\Controller',
                        'action' => 'email',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'email.rpc.email',
        ],
    ],
    'zf-rpc' => [
        'Email\\V1\\Rpc\\Email\\Controller' => [
            'service_name' => 'Email',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'email.rpc.email',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Email\\V1\\Rpc\\Email\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'Email\\V1\\Rpc\\Email\\Controller' => [
                0 => 'application/vnd.email.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'Email\\V1\\Rpc\\Email\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Email\\V1\\Rpc\\Email\\Controller' => [
            'input_filter' => 'Email\\V1\\Rpc\\Email\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Email\\V1\\Rpc\\Email\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\EmailAddress::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'toAddress',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'body',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\EmailAddress::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'fromAddress',
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'breakchainonfailure' => true,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'subject',
            ],
        ],
    ],
];
