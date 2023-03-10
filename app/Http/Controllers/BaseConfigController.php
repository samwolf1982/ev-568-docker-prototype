<?php

namespace App\Http\Controllers;

use Zend\Diactoros\Response\JsonResponse;

class BaseConfigController
{
    public function __invoke()
    {
        $localesDir = getPathDataOfApplication() . '/locale';

        $locales = array_map(function ($filename) {
            return [
                'name' => pathinfo($filename, PATHINFO_FILENAME),
                'data' => json_decode(file_get_contents($filename), true),
            ];
        }, glob(sprintf('%s/*.json', $localesDir)));

        return new JsonResponse([
            'currencies' => ['usd', 'eur'],
            'dateFormats' => ['mm/dd/yyyy', 'dd/mm/yy', 'mm/dd/yy'],
            'timeFormats' => [12, 24],
            'notificationSounds' => ['alarm', 'alarm1', 'alarm2'],
            'locales' => $locales,
        ]);
    }
}
