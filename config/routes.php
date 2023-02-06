<?php

use App\Http\Action;

/** @var \Framework\Http\Application $app */

$prefixPath = '/addons/bowling-center-management/app/public';

$app->get('base_config', $prefixPath . '/base-config', Action\BaseConfigAction::class);
$app->get('settings-get', $prefixPath . '/settings', function () {
    // print_r(func_get_args());
    return (new Action\SettingsAction())->get();
});
$app->post('settings-save', $prefixPath . '/settings', function () {
    return (new Action\SettingsAction())->save();
});


