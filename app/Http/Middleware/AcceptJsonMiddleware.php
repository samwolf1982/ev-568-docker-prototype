<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AcceptJsonMiddleware
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if (strpos(current($request->getHeader('accept')), 'application/json') !== false) {
            $request = $request->withParsedBody(json_decode($request->getBody()->getContents()));
        }

        return $next($request, $response, $next);
    }
}
