<?php

namespace App\Http\Middleware;

use ErrorException;
use Exception;
use Framework\Http\Router\Exception\ErrorDto;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ErrorHandlerMiddleware
{
    private $debug;
    public function __construct( $debug)
    {
        $this->debug = $debug;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try {
            return $next($request);
        } catch (Exception $e) {
         $error = new ErrorDto($e);
            return new JsonResponse($error->getError(), $error->getCode());
        }
    }
}
