<?php

use App\Http\Middleware;
use Framework\Http\Application;


use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Framework\Infrastructure\Connections\ConnectPostgres;
use Framework\Infrastructure\Connections\ConnectSqlite;
//use Framework\Infrastructure\PdoFactory;
use Framework\Infrastructure\DataBase\ModelSqlite;
use Framework\Infrastructure\PdoFactory;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'abstract_factories' => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => function (ContainerInterface $container) {
                return new Application(
                    $container->get(MiddlewareResolver::class),
                    $container->get(Router::class),
                    $container->get(Middleware\NotFoundHandler::class),
                    new Zend\Diactoros\Response()
//                    new Zend\Diactoros\ServerRequest()
                );
            },
            Router::class => function () {
                return new AuraRouterAdapter(new Aura\Router\RouterContainer());
            },
            MiddlewareResolver::class => function (ContainerInterface $container) {
                return new MiddlewareResolver($container, new Zend\Diactoros\Response());
            },
            Middleware\ErrorHandlerMiddleware::class => function (ContainerInterface $container) {
                    return new Middleware\ErrorHandlerMiddleware(
                    $container->get('config')['debug']
                );
            },



            // todo create another connection
            ConnectSqlite::class =>function (ContainerInterface $container) {
                $config = $container->get('config')['connect_sqlite'];
                  $applicationName= getApplicationName();
                  $instanceId=getInstanceId();

                $dbPath = str_replace('{applicationName}', $applicationName, $container->get('config')['connect_sqlite']['dsn']);
                $dbPath = str_replace('{instanceId}', $instanceId,$dbPath);

                try{
                    return  new ConnectSqlite(new \PDO($dbPath,
                        $config['username'],
                        $config['password'],
                        $config['options']
                    ));
                }catch (Exception $e){
                    throw new ErrorException($e->getMessage(),500);
                }

                //why not found??
//                return new PdoFactory(
//                    $container
//                );
            } ,


            // todo create another connection
            ConnectPostgres::class =>function (ContainerInterface $container) {
                $config = $container->get('config')['connect_postgres'];
                $applicationName= getApplicationName();
                $instanceId=getInstanceId();
                $connectSting=    getConnectionStringPostgres($config['dsn'],$config);


                try{
                    return  new ConnectPostgres(new \PDO($connectSting));
                }catch (Exception $e){
                    throw new ErrorException($e->getMessage(),500);
                }
            } ,


        ],
    ],

    'debug' => false,
];
