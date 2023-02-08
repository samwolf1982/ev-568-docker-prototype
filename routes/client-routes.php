<?php

use App\Http\Controllers;
use Framework\Infrastructure\Connections\ConnectSqlite;
use Interop\Container\ContainerInterface;

//use Psr\Container\ContainerInterface;

/** @var \Framework\Http\Application $app */

$prefixPath = '/addons/{applicationName}/{instanceId}';

//$app->get('base_config', $prefixPath . '/base-config', Action\BaseConfigAction::class);
$app->get($prefixPath . '/base-config', Controllers\BaseConfigAction::class);
$app->get($prefixPath . '/settings', 'App\Http\Action\SettingsAction@get');
$app->post($prefixPath . '/settings', 'App\Http\Action\SettingsAction@save');


$app->get("{$prefixPath}/blog", Controllers\Blog\IndexAction::class);
$app->post("{$prefixPath}/blog", Controllers\Blog\IndexAction::class);
//$app->get('/addons/bowling-center-management/app/public/blog1/', Action\Blog\IndexAction::class);
$app->get('/addons/{appName}/app/public/blog1', "App\Http\Action\Blog\IndexAction@posts");
$app->get( "{$prefixPath}/blog/{id}", Controllers\Blog\ShowAction::class, ['tokens' => ['id' => '\d+']]);