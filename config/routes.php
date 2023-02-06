<?php

use App\Http\Action;

/** @var \Framework\Http\Application $app */

$app->get('home', '/', Action\HelloAction::class);
$app->get('about', '/about', Action\AboutAction::class);
$app->get('cabinet', '/cabinet', Action\CabinetAction::class);
$app->get('blog', '/addons/bowling-center-management/app/public/blog/', Action\Blog\IndexAction::class);
$app->post('blog-p', '/blog', Action\Blog\IndexAction::class);
$app->get('blog_show', '/addons/bowling-center-management/app/public/blog/{id}', Action\Blog\ShowAction::class, ['tokens' => ['id' => '\d+']]);
