<?php

namespace App\Http\Action\Blog;

use App\ReadModel\PostReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class ShowAction
{
    private $posts;
    private $template;

    public function __construct(PostReadRepository $posts, TemplateRenderer $template)
    {
        $this->posts = $posts;
        $this->template = $template;
    }
//    public function __invoke(ServerRequestInterface $request, callable $next)
//    {
//        $id = $request->getAttribute('id');
//
//        if ($id > 2) {
//            return $next($request);
//        }
//        return new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
//    }
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
//        $appName=$request->getAttribute('appName');
//        var_dump($appName);die();
        if (!$post = $this->posts->find($request->getAttribute('id'))) {
            return $next($request);
        }

        return new JsonResponse($post);
    }


}
