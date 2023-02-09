<?php

require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';
require_once "config/functions.php";


//$dataBaseFileName=$GLOBALS['dbPath'];
$migrateDirectory=$GLOBALS['migrateDirectory'];
$seedsDirectory=$GLOBALS['seedsDirectory'];
$connectionString=$GLOBALS['connectionString'];
$dbname=$GLOBALS['dbname'];


echo PHP_EOL.'Phinx configs: '.PHP_EOL;
echo "connectionString: {$connectionString}".PHP_EOL;
echo "migrate directory: {$migrateDirectory}".PHP_EOL;
echo "seeds directory: {$seedsDirectory}".PHP_EOL;
//var_dump($connectionString); die();
return [
    'environments' =>  [
        'default_migration_table' => 'migrations',
//        'default_database' => 'migrations',
//        'default_environment' => 'development',
        'app' => [
//            'name' =>$dataBaseFileName ,
            'name' =>$dbname ,
            'connection' => new PDO("$connectionString")
//            'connection' => new PDO("pgsql:host=postgres;port=5432;dbname=project_db;user=user_1;password=1111")
        ],
    ],
    'paths' => [
        'migrations' => $migrateDirectory,
        'seeds' =>  $seedsDirectory,
    ],
    "templates"=>[
        "file"=> "console/templates/migration.template.php.dist"
    ]

];