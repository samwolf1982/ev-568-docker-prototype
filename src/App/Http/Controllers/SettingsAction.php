<?php

namespace App\Http\Controllers;

use App\ReadModel\PostReadRepository;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

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

    public function save(ServerRequest $request)
    {
        // throw new \Exception("Test");

        return new JsonResponse([
            'settings' => 555,
            'attributes' => $request->getAttributes(),
            'args' => get_class(func_get_args()[0])
        ]);
    }
}
