<?php

namespace Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Next
{
    private $queue;
    private $next;

    public function __construct(\SplQueue $queue, callable $next)
    {
        $this->queue = $queue;
        $this->next = $next;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ($this->queue->isEmpty()) {
           // var_dump($this->next);die();
//            return ($this->next)($request, $response);  //TEST CHECK IT!!!!!
//          return  call_user_func($this->next,[$request, $response]);
          return  call_user_func($this->next,$request, $response);
           // return ($this->next)($request, $response);
        }

        $middleware = $this->queue->dequeue();

        return $middleware($request, $response, function (ServerRequestInterface $request) use ($response) {
            return $this($request, $response);
        });
    }
}
