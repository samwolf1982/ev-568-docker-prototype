<?php

use App\Http\Action;
use Framework\Infrastructure\Connections\ConnectSqlite;
use Interop\Container\ContainerInterface;

//use Psr\Container\ContainerInterface;

/** @var \Framework\Http\Application $app */

$prefixPath = '/addons/{appName}/app/public';
//$prefixPath = '/addons/{appName}/{appId}';


//$app->get('base_config', $prefixPath . '/base-config', Action\BaseConfigAction::class);
$app->get($prefixPath . '/base-config', Action\BaseConfigAction::class);
$app->get( $prefixPath . '/settings', function () use ($container) {
    // print_r(func_get_args());
//    return (new Action\SettingsAction($container->get(ConnectSqlite::class)))->get();
   return $container->get(Action\SettingsAction::class)->get();
//    return (new Action\SettingsAction($container->get(ConnectSqlite::class)))->get();
});
$app->post($prefixPath . '/settings', function () {
    return (new Action\SettingsAction())->save();
});


$app->get('/addons/{appName}/app/public/blog', Action\Blog\IndexAction::class);
//$app->get('/addons/bowling-center-management/app/public/blog1/', Action\Blog\IndexAction::class);
$app->get('/addons/{appName}/app/public/blog1', "App\Http\Action\Blog\IndexAction@posts");
$app->get( '/addons/{appName}/app/public/blog/{id}', Action\Blog\ShowAction::class, ['tokens' => ['id' => '\d+']]);
