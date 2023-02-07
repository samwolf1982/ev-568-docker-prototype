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

$dbPath=str_replace('{applicationName}',$applicationName, $container->get('config')['phinx']['database']) ;
return [
    'environments' =>  [
        'default_migration_table' => 'migrations',
        'default_environment' => 'development',
//        'default_database' => $dbPath,
        'app' => [
//            'name' =>str_replace('{applicationName}',$applicationName, $container->get('config')['phinx']['database'])   ,
            'name' =>$dbPath ,
            'connection' => $container->get(PDO::class),
        ],
    ],
    'paths' => [
        'migrations' => 'storage/db/migrations',
        'seeds' =>  'storage/db/seeds',
    ],
];