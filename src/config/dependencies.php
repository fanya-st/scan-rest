<?php
return [
    'jwt-secret'=>'$bfg^&8#bvnn',
    'doctrine'=>[
        'dev_mode' => true,
        'metadata_dirs' => [__DIR__ . '/../Models'],
//        'cache_dir' => __DIR__ . '/../../var/doctrine/cache',
        'proxy_dir' => __DIR__ . '/../../var/doctrine/proxy',
        'connection' => [
            'driver' => 'pdo_pgsql',
            'host' => 'localhost',
            'port' => 5432,
            'dbname' => 'scan_db',
            'user' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf-8'
            ],
        ],
    'eloquent'=>[
        'driver' => 'pgsql',
        'host' => 'localhost',
        'database' => 'scan_db',
        'port' => 5432,
        'username' => 'postgres',
        'password' => 'postgres',
        'charset' => 'utf-8'
    ]
    ];