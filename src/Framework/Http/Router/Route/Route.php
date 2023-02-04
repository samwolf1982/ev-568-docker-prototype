<?php

namespace Framework\Http\Router\Route;

use Framework\Http\Router\Result;
use Psr\Http\Message\ServerRequestInterface;

interface Route
{
    /**
     * @param ServerRequestInterface $request
     * @return Result|null
     */
    public function match(ServerRequestInterface $request);

    /**
     * @param $name
     * @param array $params
     * @return string|null
     */
    public function generate($name, array $params = []);
}