<?php

namespace App\Http\Controllers\Blog;

use App\Models\Posts;
use App\ReadModel\PostReadRepository;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class ShowAction
{
//    private $posts;
//    private $template;

//    public function __construct(PostReadRepository $posts)
//    {
//        $this->posts = $posts;
//    }
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
        $id= $request->getAttributes()["id"];
        $post=  (new Posts())->where('id',$id)->first();

        return new JsonResponse($post);
//        $appName=$request->getAttribute('appName');
//        var_dump($appName);die();
//        if (!$post = $this->posts->find($request->getAttribute('id'))) {
//            return $next($request);
//        }

        return new JsonResponse([222]);
    }


}
