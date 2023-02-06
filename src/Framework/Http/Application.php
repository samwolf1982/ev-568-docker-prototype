<?php

namespace Framework\Http;

use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\RouteData;
use Framework\Http\Router\Router;
use Interop\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Webimpress\HttpMiddlewareCompatibility\HandlerInterface as RequestHandlerInterface;
use Zend\Stratigility\MiddlewarePipe;

class Application implements MiddlewareInterface, RequestHandlerInterface
{
    private $resolver;
    private $router;
    private $default;
    private $pipeline;
    private $responsePrototype;

    public function __construct(MiddlewareResolver $resolver, Router $router, callable $default, ResponseInterface $responsePrototype)
    {
        $this->resolver = $resolver;
        $this->router = $router;
        $this->pipeline = new MiddlewarePipe();
        $this->pipeline->setResponsePrototype($responsePrototype);
        $this->default = $default;
        $this->responsePrototype = $responsePrototype;
    }

    /**
     * @param $path
     * @param null $middleware
     * @return MiddlewarePipe
     */
    public function pipe($path, $middleware = null)
    {
        if ($middleware === null) {
            return $this->pipeline->pipe($this->resolver->resolve($path));
        }
        return $this->pipeline->pipe($path, $this->resolver->resolve($middleware));
    }

    /**
     * @param $path
     * @param $handler
     * @param array $methods
     * @param array $options
     */
    private function route($path, $handler, array $methods, array $options = [])
    {
        $this->router->addRoute(new RouteData($path, $handler, $methods, $options));
    }

    /**
     * @param $path
     * @param $handler
     * @param array $options
     */
    public function any($path, $handler, array $options = [])
    {
        $this->route($path, $handler, $options);
    }

    /**
     * @param $path
     * @param $handler
     * @param array $options
     */
    public function get($path, $handler, array $options = [])
    {
        $this->route( $path, $handler, ['GET'], $options);
    }

    /**
     * @param $path
     * @param $handler
     * @param array $options
     */
    public function post($path, $handler, array $options = [])
    {
        $this->route($path, $handler, ['POST'], $options);
    }

    /**
     * @param $path
     * @param $handler
     * @param array $options
     */
    public function put($path, $handler, array $options = [])
    {
        $this->route($path, $handler, ['PUT'], $options);
    }

    /**
     * @param $path
     * @param $handler
     * @param array $options
     */
    public function patch($path, $handler, array $options = [])
    {
        $this->route($path, $handler, ['PATCH'], $options);
    }

    /**
     * @param $path
     * @param $handler
     * @param array $options
     */
    public function delete($path, $handler, array $options = [])
    {
        $this->route($path, $handler, ['DELETE'], $options);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request)
    {
//        return ($this->pipeline)($request, $this->responsePrototype, $this->default); todo
        return call_user_func($this->pipeline,$request, $this->responsePrototype, $this->default);
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
//        return ($this->pipeline)($request, $response, $next); todo
        return call_user_func($this->pipeline,$request, $response, $next);
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        return $this->pipeline->process($request, $handler);
    }
}
