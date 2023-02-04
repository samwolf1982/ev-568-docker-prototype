<?php

namespace Framework\Template\Php\Extension;

use Framework\Http\Router\Router;
use Framework\Template\Php\Extension;
use Framework\Template\Php\SimpleFunction;

class RouteExtension extends Extension
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @return SimpleFunction[]
     */
    public function getFunctions()
    {
        return [
            new SimpleFunction('path', [$this, 'generatePath']),
        ];
    }

    /**
     * @param $name
     * @param array $params
     * @return string
     */
    public function generatePath($name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }
}
