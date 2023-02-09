<?php

namespace App\Models;

use Framework\Infrastructure\DataBase\ModelSqlite;

class Setting extends ModelSqlite
{
    public $table = 'settings';

    public function all()
    {
        $settings = [];
        foreach (parent::all() as $setting) {
            $settings[$setting['type']][$setting['key']] = json_decode($setting['value']);
        }
        return $settings;
    }

    public function save($key, $value, $type)
    {
        $value = json_encode($value);

        if ($setting = $this->where('key', $key)->where('type', $type)->first()) {
            $setting->update(compact('value'));
        } else {
            $this->insert(compact('key', 'value', 'type'));
        }
    }
}
