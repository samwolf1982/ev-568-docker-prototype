<?php

namespace App\Models;

use App\ReadModel\Views\PostView;
use Framework\Infrastructure\Connections\ConnectSqlite;
use Framework\Infrastructure\DataBase\ModelSqlite;
use PDO;


class Posts  extends ModelSqlite
{


    private $pdo;

}
