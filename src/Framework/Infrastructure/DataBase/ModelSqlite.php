<?php

namespace Framework\Infrastructure\DataBase;

use Framework\Infrastructure\Connections\ConnectSqlite;
use NotORM;

class ModelSqlite
{

    public $table;
    private $db;


    /**
     * @param $table
     */
    public function __construct()
    {
        // todo :)
        $container=$GLOBALS['container'];
        $connect= $container->get(ConnectSqlite::class);
        $pdo = $connect->getPdo();// new PDO("sqlite:storage/bowling-center-management/db.sqlite");
        //todo check multi connections
        $this->db = new NotORM($pdo);
    }

    public function __call($name, $arguments)
    {
        $table = $this->table;
        if (empty($this->table)) {
            $table = strtolower($this->getName());
        }
        $result = $this->db->$table()->$name(...$arguments);
        return $result;

    }


    public static function __callStatic($name, $arguments)
    {
//        var_dump(self::$table);die();
//        var_dump(self::class);die();
    }

    public function getName()
    {
        $path = explode('\\', get_class($this));
        return array_pop($path);
    }
}
