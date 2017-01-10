<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // App
        'app' => [
            'env' => 'dev',
            'key' => '?0x1nh@f0lg@t0',
        ],

        // Monolog
        'logger' => [
            'name' => 'api',
            'path' => __DIR__ . '/../logs/' . date('Y-m-d') . '.log',
        ],

        // Database
        'database' => [
            'driver'    		=> 'pgsql',
            'host'      		=> 'localhost',
            'database'  	=> 'trend_project',
            'username'  	=> 'postgres',
            'password'  	=> 'root',
			'port'				=> 5432
        ],

        // Router
        'router' => [
            'public' => [
                '/publico',
            ]
        ],
    ],
];
