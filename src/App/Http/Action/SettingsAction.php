<?php

namespace App\Http\Action;

use Zend\Diactoros\Response\JsonResponse;

class SettingsAction
{
    public function get()
    {
        return new JsonResponse([
            'settings' => 555
        ]);
    }

    public function save()
    {
        return new JsonResponse([
            'settings' => 555
        ]);
    }
}
