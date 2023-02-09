<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class SettingsController
{
    public function get()
    {
        $settings = (new Setting)->all();
        return new JsonResponse($settings);
    }

    public function save(ServerRequestInterface $request)
    {
        $settings = $request->getParsedBody();
        $setting = new Setting;

        foreach ((array)$settings as $type => $list) {
            foreach ($list as $key => $value) {
                $setting->save($key, $value, $type);
            }
        }

        return $this->get();
    }
}
