<?php

return [
    'auth' => [
        'users' => [
            'admin' => 'password',
        ],
    ],

    'pdo' => [
        // 'dsn' => 'mysql:host=localhost;port=3306;dbname=app;charset=utf8mb4',

            'dsn' => 'sqlite:/var/www/storage/db.sqlite',
            'username' => '',
            'password' => '',


    ],

];
