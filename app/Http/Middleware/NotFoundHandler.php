<?php

namespace App\Http\Middleware;

use Aura\Router\Exception\RouteNotFound;
use DomainException;
use Exception;
use Framework\Http\Router\Exception\RouteNotFoundException;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class NotFoundHandler
{
    public function __construct()
    {

    }
//    public function __invoke(ServerRequestInterface $request) // don't work 5.6 todo it
    public function __invoke(ServerRequestInterface $request)
    {
        throw new \ErrorException('Not Found',404);
//        return new JsonResponse(['ok' => false], 404);
    }
}