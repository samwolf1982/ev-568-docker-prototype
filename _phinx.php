<?php

use Framework\Infrastructure\Connections\ConnectSqlite;
use Framework\Infrastructure\Connections\ConnectSqlitePhinx;
use Framework\Infrastructure\PdoFactory;

require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';
require_once "config/functions.php";
// todo ask about it  how to run  in the console?
$applicationName= getApplicationName();
if(!$applicationName){
    $applicationName='bowling-center-management';
}


$dataBaseFileName="data/bowling-center-management/instances/DEVc294b906e-1556261996.04-3615142968/db/db.sqlite";
$migrateDirectory="data/bowling-center-management/db/migrations";
$seedsDirectory="data/bowling-center-management/db/seeds";

//var_dump($dataBaseFileName);die();
echo PHP_EOL.'Phinx configs: '.PHP_EOL;
echo "file: {$dataBaseFileName}".PHP_EOL;
echo "migrate directory: {$dataBaseFileName}".PHP_EOL;
echo "seeds directory: {$seedsDirectory}".PHP_EOL;

return [
    'environments' =>  [
        'default_migration_table' => 'migrations',
        'default_environment' => 'development',
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