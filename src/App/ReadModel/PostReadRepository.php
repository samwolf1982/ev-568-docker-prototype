<?php

namespace App\ReadModel;

use App\ReadModel\Views\PostView;
use Framework\Infrastructure\Connections\ConnectSqlite;
use PDO;


class PostReadRepository
{
    private $pdo;

//    public function __construct(Pdo $pdo)
    public function __construct(ConnectSqlite $pdo)
    {
        $this->pdo = $pdo->getPdo();
    }

    /**
     * @return PostView[]
     */
    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM posts ORDER BY id DESC');

        return array_map([$this, 'hydratePost'], $stmt->fetchAll());
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);

        return ($row = $stmt->fetch()) ? $this->hydratePost($row) : null;
    }

    private function hydratePost(array $row)
    {
        $view = new PostView();

        $view->id = (int)$row['id'];
        //$view->date = new \DateTimeImmutable($row['date']);
        $view->title = $row['title'];
        $view->content = $row['content'];

        return $view;
    }
}
