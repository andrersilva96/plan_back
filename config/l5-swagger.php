<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'API Documentation',
            ],
            'routes' => [
                'api' => 'api/documentation',
            ],
            'paths' => [
                'docs' => storage_path('api-docs'),
                'annotations' => [
                    base_path('app'),
                ],
            ],
        ],
    ],
    'generate_always' => false,
    'generate_yaml_copy' => false,
    'proxy' => false,
    'additional_config_url' => 'null',
    'apply_constraints' => false,
];
