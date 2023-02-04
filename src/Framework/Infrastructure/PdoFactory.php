<?php

namespace Framework\Infrastructure;

use PDO;
use Psr\Container\ContainerInterface;
//why  not found work??
class PdoFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['connect_sqlite'];
      // var_dump(123);die();
        return new PDO(
            $config['dsn'],
            $config['username'],
            $config['password'],
            $config['options']
        );
    }
}
