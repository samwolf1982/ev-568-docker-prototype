<?php

namespace Framework\Http\Router\Route;

use Framework\Http\Router\Result;
use Psr\Http\Message\ServerRequestInterface;

class RegexpRoute implements Route
{
    private $name;
    private $pattern;
    private $handler;
    private $tokens;
    private $methods;

    public function __construct($name, $pattern, $handler, array $methods, array $tokens = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->tokens = $tokens;
        $this->methods = $methods;
    }

    /**
     * @param ServerRequestInterface $request
     * @return Result|null
     */
    public function match(ServerRequestInterface $request)
    {
        if ($this->methods && !\in_array($request->getMethod(), $this->methods, true)) {
            return null;
        }

        $pattern = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) {
            $argument = $matches[1];
            // todo check logic
            $replace = isset($this->tokens[$argument]) ?$this->tokens[$argument]: '[^}]+';
            return '(?P<' . $argument . '>' . $replace . ')';
        }, $this->pattern);

        $path = $request->getUri()->getPath();
        
        if (!preg_match('~^' . $pattern . '$~i', $path, $matches)) {
            return null;
        }

        return new Result(
            $this->name,
            $this->handler,
            array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
        );
    }

    /**
     * @param $name
     * @param array $params
     * @return string|null
     */
    public function generate($name, array $params = [])
    {
        $arguments = array_filter($params);

        if ($name !== $this->name) {
            return null;
        }

        $url = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use (&$arguments) {
            $argument = $matches[1];
            if (!array_key_exists($argument, $arguments)) {
                throw new \InvalidArgumentException('Missing parameter "' . $argument . '"');
            }
            return $arguments[$argument];
        }, $this->pattern);

        return $url;
    }
}
