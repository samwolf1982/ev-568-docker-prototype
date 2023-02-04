<?php

namespace App\Http\Action;

use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class AboutAction
{
    private $template;

    public function __construct(TemplateRenderer $template)
    {
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        return new JsonResponse(['about'=>'']);
        //don't use it only json
//        return new HtmlResponse($this->template->render('app/about'));
    }
}
