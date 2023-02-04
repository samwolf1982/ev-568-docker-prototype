<?php

namespace Framework\Http;

class ActionResolver
{
    /**
     * @param $handler
     * @return callable
     */
    public function resolve($handler)
    {
        return \is_string($handler) ? new $handler() : $handler;
    }
}
