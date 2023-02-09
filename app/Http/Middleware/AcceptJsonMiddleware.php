<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AcceptJsonMiddleware
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if (strpos(strtolower(current($request->getHeader('accept'))), 'application/json') !== false) {
            if ($contents = $request->getBody()->getContents()) {
                $request = $request->withParsedBody(json_decode($contents));
            }
        }

        return $next($request, $response, $next);
    }
}
