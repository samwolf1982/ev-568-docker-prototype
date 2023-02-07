<?php

use App\Http\Middleware;
use Framework\Http\Application;


use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Framework\Infrastructure\Connections\ConnectSqlite;
//use Framework\Infrastructure\PdoFactory;
use Framework\Infrastructure\PdoFactory;
use Framework\Template\TemplateRenderer;
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
//                 todo ask about it  how to run  in the console?
                  $applicationName='bowling-center-management';
                  if($applicationName){
                      return  new ConnectSqlite(new \PDO( str_replace('{applicationName}',$applicationName,$config['dsn']) ,
                          $config['username'],
                          $config['password'],
                          $config['options']
                      ));
                  }else{
                      throw new ErrorException('Empty application name',500);
                  }
                //why not found??
//                return new PdoFactory(
//                    $container
//                );
            } ,
            //todo only console migration need fix
            PDO::class =>function (ContainerInterface $container) {
                $config = $container->get('config')['connect_sqlite'];
                $applicationName= getApplicationName();
//                 todo ask about it  how to run  in the console?
                $applicationName='bowling-center-management';
                if($applicationName){
                    return new PDO( str_replace('{applicationName}',$applicationName,$config['dsn']) ,
                        $config['username'],
                        $config['password'],
                        $config['options']
                    );
                }else{
                    throw new ErrorException('Empty application name',500);
                }
            } ,



        ],
    ],

    'debug' => false,
];
