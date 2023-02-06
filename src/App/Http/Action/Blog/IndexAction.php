<?php

namespace App\Http\Action\Blog;

use App\ReadModel\PostReadRepository;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class IndexAction
{
    private $posts;
    private $template;

//    public function __construct(PostReadRepository $posts, TemplateRenderer $template)
    public function __construct(PostReadRepository $posts)
    {
        $this->posts = $posts;
//        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $posts = $this->posts->getAll();
        return new JsonResponse($posts);
    }
    public function posts(){

        $posts = $this->posts->getAll();
        return new JsonResponse($posts);
    }
}
