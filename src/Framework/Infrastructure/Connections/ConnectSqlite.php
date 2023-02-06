<?php

namespace Framework\Infrastructure\Connections;
use Exception;
use PDO;

class ConnectSqlite
{
   private $pdo;

    /**
     * ConnectSqlite constructor.
     */
    public function __construct(Pdo $pdo)
    {

        $this->pdo=$pdo;
    }

    /**
     * @return Pdo
     */
    public function getPdo()
    {

        return $this->pdo;
    }
}
