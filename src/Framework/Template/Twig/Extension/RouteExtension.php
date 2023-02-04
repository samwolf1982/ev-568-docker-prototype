<?php

namespace Framework\Template\Twig\Extension;

use Framework\Http\Router\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RouteExtension extends AbstractExtension
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('path', [$this, 'generatePath']),
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
