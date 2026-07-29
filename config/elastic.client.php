<?php declare(strict_types=1);

return [
    'default' => env('ELASTIC_CONNECTION', 'default'),
    'connections' => [
        'default' => [
            'hosts' => [
                env('ELASTIC_HOST', 'es01:9200'),
            ],/*
            'basicAuthentication' => [
                env('ELASTIC_USERNAME'),
                env('ELASTIC_PASSWORD'),
            ],*/
        ],
    ],
];
