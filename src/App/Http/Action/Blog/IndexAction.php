<?php

namespace App\Http\Action\Blog;

use App\ReadModel\PostReadRepository;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class IndexAction
{
    private $posts;

    public function __construct(PostReadRepository $posts)
    {
        $this->posts = $posts;
//        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request)
    {
//        var_dump($this->posts);die();
        $posts = $this->posts->getAll();
        return new JsonResponse($posts);
    }
    public function posts(){

        $posts = $this->posts->getAll();
        return new JsonResponse($posts);
    }
}
