<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BasicAuthMiddleware
{
//    public const ATTRIBUTE = '_user';
    const ATTRIBUTE = '_user';

    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $username = isset( $request->getServerParams()['PHP_AUTH_USER']) ?$request->getServerParams()['PHP_AUTH_USER']: null;
        $password = isset($request->getServerParams()['PHP_AUTH_PW']) ?$request->getServerParams()['PHP_AUTH_PW']: null;
//        var_dump($username);die();
        if (!empty($username) && !empty($password)) {
            foreach ($this->users as $name => $pass) {
                if ($username === $name && $password === $pass) {
                    return $next($request->withAttribute(self::ATTRIBUTE, $name), $response);
                }
            }
        }

        return $response
            ->withStatus(401)
            ->withHeader('WWW-Authenticate', 'Basic realm=Restricted area');
    }
}
