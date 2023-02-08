<?php

require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';
require_once "config/functions.php";


$dataBaseFileName=$GLOBALS['dbPath'];
$migrateDirectory=$GLOBALS['migrateDirectory'];
$seedsDirectory=$GLOBALS['seedsDirectory'];


echo PHP_EOL.'Phinx configs: '.PHP_EOL;
echo "file: {$dataBaseFileName}".PHP_EOL;
echo "migrate directory: {$dataBaseFileName}".PHP_EOL;
echo "seeds directory: {$seedsDirectory}".PHP_EOL;

return [
    'environments' =>  [
        'default_migration_table' => 'migrations',
//        'default_environment' => 'development',
        'app' => [
            'name' =>$dataBaseFileName ,
            'connection' => new PDO("sqlite:{$dataBaseFileName}")
        ],
    ],
    'paths' => [
        'migrations' => $migrateDirectory,
        'seeds' =>  $seedsDirectory,
    ],
];