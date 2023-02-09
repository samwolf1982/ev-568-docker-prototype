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
$className=$argumentsList['className'];

$host=$argumentsList['host'];
$port=$argumentsList['port'];
$dbname=$argumentsList['dbname'];
$user=$argumentsList['user'];
$password=$argumentsList['password'];



if(empty($port)){
    $port="5432";
}


$config = $container->get('config')['connect_postgres'];
$connectionString=    getConnectionStringPostgres($config['dsn'],array_merge( $argumentsList,['port'=>$port]));

//$connectionString


if(empty($commandParams)){
    $commandParams="migrate";
}


$extendConfigs=[];
echo PHP_EOL;
if( empty($applicationName) || empty($instanceId) ){
    echo 'Not enough parameters  '.PHP_EOL;
    echo 'Use --name, --id  '.PHP_EOL;
    die();
}

$step=1;

if(!empty($commandParams)){
    switch ($commandParams){
        case 'create' :
            //create migration file
            if(empty($className)){
                echo 'Not enough parameters  '.PHP_EOL;
                echo 'Use --className'.PHP_EOL;
                die();
            }else{

                $extendConfigs[]=['name'=> $className ];
            }
            break;
        case 'rollback' :
            //create migration file
            if(!empty($argumentsList['step'])){
                if(intval($argumentsList['step'])){
                    $step=$argumentsList['step'];
                }
            }
            break;
    }
}



//$dbPath = str_replace('{applicationName}', $applicationName, $container->get('config')['phinx']['databaseSqlite']);
//$dbPath = str_replace('{instanceId}', $instanceId,$dbPath);
$migrateDirectory = str_replace('{applicationName}', $applicationName, $container->get('config')['phinx']['migrationPostgresDirectory']);
$seedsDirectory = str_replace('{applicationName}', $applicationName, $container->get('config')['phinx']['seedsPostgresDirectory']);


//echo "Data base file is: {$dbPath}".PHP_EOL;
echo "Migrate directory is: {$migrateDirectory}".PHP_EOL;
echo "Seeds directory is: {$seedsDirectory}".PHP_EOL;

$configs=[];
$phinx = new PhinxApplication();
//$command = $phinx->find('migrate');
$command = $phinx->find($commandParams);

$arguments = [
    'command'         =>$commandParams,
    '--configuration' => 'console/postgresPhinx.php'
];

$arguments=array_merge($arguments,...$extendConfigs);

$input = new ArrayInput($arguments);
//$returnCode = $command->run(new ArrayInput($arguments), $output);







$phinx->setAutoExit(false);
$output = new ConsoleOutput(fopen('php://memory', 'a', true));
//$returnCode = $command->run(new ArrayInput($arguments), new NullOutput());
for ($i=0;$i<$step;$i++){
    $returnCode = $command->run(new ArrayInput($arguments), $output);
    echo "Code: {$returnCode}".PHP_EOL;
}
