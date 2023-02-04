<?php

namespace Framework\Container;

interface ContainerInterface
{
    /**
     * @param $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get($id);

    /**
     * @param $id
     * @return bool
     */
    public function has($id);
}