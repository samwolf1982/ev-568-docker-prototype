<?php


use Framework\Infrastructure\Connections\ConnectSqlite;
use Framework\Infrastructure\Connections\ConnectSqlitePhinx;
use Framework\Infrastructure\PdoFactory;
use Phinx\Console\PhinxApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\StreamOutput;

require 'vendor/autoload.php';



/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';
require_once "config/functions.php";



$argumentsList=arguments($argv);
$applicationName=$argumentsList['name'];
$instanceId=$argumentsList['id'];
$commandParams=$argumentsList['command'];
if(empty($commandParams)){
    $commandParams="migrate";
}
echo PHP_EOL;
if( empty($applicationName) || empty($instanceId) ){
    echo 'Not enough parameters  '.PHP_EOL;
    echo 'Use --name, --id  '.PHP_EOL;
    die();
}

$dbPath = str_replace('{applicationName}', $applicationName, $container->get('config')['phinx']['databaseSqlite']);
$dbPath = str_replace('{instanceId}', $instanceId,$dbPath);
$migrateDirectory = str_replace('{applicationName}', $applicationName, $container->get('config')['phinx']['migrationSqliteDirectory']);
$seedsDirectory = str_replace('{applicationName}', $applicationName, $container->get('config')['phinx']['seedsSqliteDirectory']);


echo "Data base file is: {$dbPath}".PHP_EOL;
echo "Migrate directory is: {$migrateDirectory}".PHP_EOL;
echo "Seeds directory is: {$seedsDirectory}".PHP_EOL;

$phinx = new PhinxApplication();
//$command = $phinx->find('migrate');
$command = $phinx->find($commandParams);
$arguments = [
    'command'         =>$commandParams,
//    '--environment'   => 'development',
    '--configuration' => 'console/sqlitePhinx.php'
];
$input = new ArrayInput($arguments);
//$returnCode = $command->run(new ArrayInput($arguments), $output);







$phinx->setAutoExit(false);
$output = new ConsoleOutput(fopen('php://memory', 'a', true));
//$returnCode = $command->run(new ArrayInput($arguments), new NullOutput());
$returnCode = $command->run(new ArrayInput($arguments), $output);

echo "Code: {$returnCode}".PHP_EOL;
//var_dump(arguments($argv));

//exit();
//die();
//return [
//    'environments' => [
//        'default_migration_table' => 'migrations',
//        'default_environment' => 'development',
////        'default_database' => $dbPath,
//        'app' => [
////            'name' =>str_replace('{applicationName}',$applicationName, $container->get('config')['phinx']['database'])   ,
//            'name' => $dbPath,
////            'connection' => $container->get(PDO::class),
//            'connection' => $container->get(PDO::class),
//        ],
//    ],
//    'paths' => [
//        'migrations' => "{$applicationName}/data/db/migrations",
//        'seeds' => "{$applicationName}/data/db/seeds",
//    ],
//];