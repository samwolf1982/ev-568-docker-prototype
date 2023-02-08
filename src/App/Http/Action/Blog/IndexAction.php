<?php

namespace App\Http\Action\Blog;

use App\Models\Posts;
use App\ReadModel\PostReadRepository;
use NotORM;
use PDO;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class IndexAction
{
    private $posts;

    public function __construct(PostReadRepository $posts)
    {
        $this->posts = $posts;
    }

    public function __invoke(ServerRequestInterface $request)
    {

     $post=  (new Posts())->where('title','Dolores 123')->where('id',3)->get();
     $posts=  (new Posts())->where('title','Dolores 123')->all();


        var_dump($post['id']);
        foreach ($posts as $item) {
            var_dump($item["id"]);
     }
//     $res=$post->fetch();
//     var_dump($res);
//     var_dump($res['id']);
//     var_dump($res['title']);die();

//        $pdo = new PDO("sqlite:storage/bowling-center-management/db.sqlite");
//        $db = new NotORM($pdo);
//        foreach ($db->posts() as $application) { // get all applications
////            var_dump($application);die();
//            echo "$application[title]\n"; // print application title
//        }
//        var_dump($this->posts);die();
        $posts = $this->posts->getAll();
        return new JsonResponse($posts);
    }
    public function posts(){

        $posts = $this->posts->getAll();
        return new JsonResponse($posts);
    }
}
