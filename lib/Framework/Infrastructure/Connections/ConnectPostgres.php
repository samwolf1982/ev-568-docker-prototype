<?php

namespace Framework\Infrastructure\Connections;
use PDO;

class ConnectPostgres
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
