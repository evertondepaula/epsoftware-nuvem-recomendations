<?php

return [

    'mongodb' => [

        'auth_db'    => env('MONGO_AUTH_DATABASE', 'admin'),
        'host'       => env('MONGO_HOST'),
        'port'       => env('MONGO_PORT'),
        'database'   => env('MONGO_DATABASE'),
        'username'   => env('MONGO_USERNAME'),
        'password'   => env('MONGO_PASSWORD'),

        'replicas' => [
            // 0 => [
            //     'host' => '',
            //     'port' => '',
            // ],
        ],
    ],

    'documents' => [
        'dirs' => [
            app_path(). '/Documents',
        ],
    ],

    'filters' => [],

    'proxie' => [
        'dir'       => resource_path(). '/doctrine/proxies',
        'namespace' => 'Proxies'
    ],

    'hydrators' => [
        'dir'       => resource_path(). '/doctrine/hydrators',
        'namespace' => 'Hydrators',
    ],

];
