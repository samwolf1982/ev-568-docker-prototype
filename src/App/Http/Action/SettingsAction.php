<?php

namespace App\Http\Action;

use App\ReadModel\PostReadRepository;
use Framework\Infrastructure\Connections\ConnectSqlite;
use Zend\Diactoros\Response\JsonResponse;

class SettingsAction
{

    private $posts;
    public function __construct(PostReadRepository $posts)
    {
        $this->posts = $posts;
    }

    public function get()
    {
//        $stmt = $this->pdo->query('SELECT * FROM posts ORDER BY id DESC');
//
//        $obk= $stmt->fetchAll();
        return new JsonResponse([
            'settings' => 5552,
        ]);
    }

    public function save()
    {
        return new JsonResponse([
            'settings' => 555
        ]);
    }
}
