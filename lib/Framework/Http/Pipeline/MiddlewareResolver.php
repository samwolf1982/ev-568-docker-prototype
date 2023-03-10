<?php

namespace Framework\Http\Pipeline;

use App\Http\Controllers\SettingsController;
use Aura\Router\Exception;
use Interop\Http\Server\MiddlewareInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\MiddlewarePipe;
use Psr\Container\NotFoundExceptionInterface;

class MiddlewareResolver
{
    private $container;
    private $responsePrototype;

    public function __construct(ContainerInterface $container, ResponseInterface $responsePrototype)
    {
        $this->container = $container;
        $this->responsePrototype = $responsePrototype;
    }

    /**
     * @param $handler
     * @return callable
     */
    public function resolve($handler)
    {
        if (\is_array($handler)) {
            return $this->createPipe($handler);
        }

        if (\is_string($handler)) {
            if ($this->container->has($handler)) {
                return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($handler) {
                    $middleware = $this->resolve($this->container->get($handler));
                    return $middleware($request, $response, $next);
                };
            } else if (strpos($handler, '@')) {
                return function () use ($handler) {
                    list($class, $method) = explode('@', $handler);
                    $entry = @$this->container->get($class);
                    return call_user_func_array([$entry, $method], func_get_args());
                };
            }
        }

        if ($handler instanceof MiddlewareInterface) {
            return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($handler) {
                return $handler->process($request, new InteropHandlerWrapper($next));
            };
        }

        if (\is_object($handler)) {
            $reflection = new \ReflectionObject($handler);
            if ($reflection->hasMethod('__invoke')) {
                $method = $reflection->getMethod('__invoke');
                $parameters = $method->getParameters();
                if (\count($parameters) === 2 && $parameters[1]->isCallable()) {
                    return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($handler) {
                        return $handler($request, $next);
                    };
                }
                return $handler;
            }
        }

        throw new UnknownMiddlewareTypeException($handler);
    }

    /**
     * @param array $handlers
     * @return MiddlewarePipe
     */
    private function createPipe(array $handlers)
    {
        $pipeline = new MiddlewarePipe();
        $pipeline->setResponsePrototype($this->responsePrototype);
        foreach ($handlers as $handler) {
            $pipeline->pipe($this->resolve($handler));
        }
        return $pipeline;
    }
}
