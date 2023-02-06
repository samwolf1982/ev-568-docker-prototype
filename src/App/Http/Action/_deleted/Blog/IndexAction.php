<?php

namespace App\Http\Action\Blog;

use App\ReadModel\PostReadRepository;
use Framework\Template\TemplateRenderer;
use PDO;
use Zend\Diactoros\Response\HtmlResponse;
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

    public function __invoke()
    {
//        $myPDO = new PDO('sqlite:/var/www/storage/db.sqlite','user_1','1111',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
//
//        $stmt = $myPDO->query('SELECT * FROM posts ORDER BY id DESC');
        $posts = $this->posts->getAll();
        return new JsonResponse($posts);
//        $posts = $this->posts->getAll();
//        return new JsonResponse($posts);
//        return new JsonResponse([
//            ['id' => 2, 'title' => 'The Second Post'],
//            ['id' => 1, 'title' => 'The First Post'],
//        ]);
        //todo if need do it now only json responce
//        return new HtmlResponse($this->template->render('app/blog/index', [
//            'posts' => $posts,
//        ]));
    }
}
