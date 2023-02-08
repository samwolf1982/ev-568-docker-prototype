<?php

namespace App\Http\Action\Blog;

use App\Models\Posts;
use App\ReadModel\PostReadRepository;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class IndexAction
{

    public function __construct()
    {
    }

    public function __invoke(ServerRequestInterface $request)
    {

        return new JsonResponse($request->getParsedBody());
     $post=  (new Posts())->where('title','Dolores 123')->where('id',3)->first();
     $posts=  (new Posts())->where('title','Dolores 123')->all();
//        var_dump($post['id']);
//        foreach ($posts as $item) {
//            var_dump($item["id"]);
//        }
        return new JsonResponse([$post,$posts]);
    }
}
