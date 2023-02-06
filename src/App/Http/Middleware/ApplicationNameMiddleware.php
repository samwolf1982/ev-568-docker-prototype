<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApplicationNameMiddleware
{
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $extraData=new \stdClass();
        $request->appli='xxx';
        $response = $next($request);

        return $response;
    }
}
