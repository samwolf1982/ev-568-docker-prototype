<?php

use App\Http\Middleware;

/** @var \Framework\Http\Application $app */

$app->pipe(Middleware\CorsMiddleware::class);
$app->pipe(Middleware\AcceptJsonMiddleware::class);
$app->pipe(Middleware\ErrorHandlerMiddleware::class);
//$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(Middleware\ProfilerMiddleware::class);
//$app->pipe(Middleware\ApplicationNameMiddleware::class);
$app->pipe(Framework\Http\Middleware\RouteMiddleware::class);

$app->pipe('cabinet', Middleware\BasicAuthMiddleware::class);

$app->pipe(Framework\Http\Middleware\DispatchMiddleware::class);

