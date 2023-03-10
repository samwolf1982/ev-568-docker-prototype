<?php

use Framework\Http\Application;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

/**
 * @var \Psr\Container\ContainerInterface $container
 * @var \Framework\Http\Application $app
 */

chdir(dirname(__DIR__));
require 'vendor/autoload.php';
include "lib/Framework/Infrastructure/DataBase/NotORM.php";
require_once "config/functions.php";
$container = require 'config/container.php';

$app = $container->get(Application::class);

require 'config/pipeline.php';
require 'routes/admin-routes.php';
require 'routes/client-routes.php';

$request = ServerRequestFactory::fromGlobals();
$response = $app->handle($request);

### Sending

//$emitter = new ResponseSender();
//$emitter->send($response);

$emitter = new SapiEmitter();
$emitter->emit($response);
