<?php

namespace Framework\Template;

interface TemplateRenderer
{
    /**
     * @param $name
     * @param array $params
     * @return string
     */
    public function render($name, array $params = []);
}
