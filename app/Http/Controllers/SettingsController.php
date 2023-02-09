<?php

namespace App\Http\Controllers;

use App\ReadModel\PostReadRepository;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

class SettingsController
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


        $request = $request->withParsedBody(json_decode($request->getBody()->getContents()));

        return new JsonResponse([
            'settings' => 555,
            'attributes' => $request->getAttributes(),
            'args' => array_map('get_class', func_get_args()),

            'parset_body' => $request->getParsedBody(),
        ]);
    }
}