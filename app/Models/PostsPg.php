<?php

namespace App\Models;

use App\ReadModel\Views\PostView;
use Framework\Infrastructure\Connections\ConnectSqlite;
use Framework\Infrastructure\DataBase\ModelPostgres;
use Framework\Infrastructure\DataBase\ModelSqlite;
use PDO;


class PostsPg  extends ModelPostgres
{

    public $table='posts';
    private $pdo;

}
