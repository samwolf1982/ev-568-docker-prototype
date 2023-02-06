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

$container = require 'config/container.php';

//$app = $container->get(PDO::class);
$app = $container->get(Application::class);
//$container->get('PDO');
require 'config/pipeline.php';
require 'config/routes.php';

$request = ServerRequestFactory::fromGlobals();
$response = $app->handle($request);

header('Access-Control-Allow-Origin: *');

//$response = $response->withHeader('X-Developer', 'PanKotskiy');
### Sending

//$emitter = new ResponseSender();
//$emitter->send($response);

$emitter = new SapiEmitter();
$emitter->emit($response);
