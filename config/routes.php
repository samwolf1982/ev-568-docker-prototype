<?php

use App\Http\Action;

/** @var \Framework\Http\Application $app */

$prefixPath = '/addons/bowling-center-management/app/public';

$app->get('base_config', $prefixPath . '/base-config', Action\BaseConfigAction::class);



