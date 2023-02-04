<?php

namespace Framework\Template\Php;

use Exception;
use Framework\Template\TemplateRenderer;

class PhpRenderer implements TemplateRenderer
{
    private $path;
    /**
     * @var Extension[]
     */
    private $extensions = [];
    private $extend;
    private $blocks = [];
    private $blockNames;

    public function __construct($path)
    {
        $this->path = $path;
        $this->blockNames = new \SplStack();
    }

    /**
     * @param Extension $extension
     */
    public function addExtension(Extension $extension)
    {
        $this->extensions[] = $extension;
    }

    /**
     * @param $name
     * @param array $params
     * @return string
     */
    public function render($name, array $params = [])
    {
//        var_dump($name);
//        var_dump($params);die();
        $level = ob_get_level();
        $templateFile = $this->path . '/' . $name . '.php';
//        $templateFile = $this->path . '/' . $name . '.php';
        $this->extend = null;

        try {
            ob_start();
            extract($params, EXTR_OVERWRITE);
//            var_dump($templateFile);die();

            require $templateFile;
            $content = ob_get_clean();

        } catch (Exception $e) {
//            var_dump(1);die();
            while (ob_get_level() > $level) {
                ob_end_clean();
            }
            throw $e;
        }
//        catch (\Throwable $e) {
//            var_dump(2);die();
//            while (ob_get_level() > $level) {
//                ob_end_clean();
//            }
//            throw $e;
//        }

        if (!$this->extend) {
            return $content;
        }

        return $this->render($this->extend);
    }

    /**
     * @param $view
     */
    public function extend($view)
    {
        $this->extend = $view;
    }

    /**
     * @param $name
     * @param $content
     */
    public function block($name, $content)
    {
//        var_dump(122);die();
        if ($this->hasBlock($name)) {
            return;
        }
        $this->blocks[$name] = $content;
    }

    /**
     * @param $name
     * @return bool
     */
    public function ensureBlock($name)
    {

        if ($this->hasBlock($name)) {
            return false;
        }
        $this->beginBlock($name);
        return true;
    }

    /**
     * @param $name
     */
    public function beginBlock($name)
    {
        $this->blockNames->push($name);
        ob_start();
    }

    /**
     *
     */
    public function endBlock()
    {
        $content =  ob_get_clean();
        $name = $this->blockNames->pop();
        if ($this->hasBlock($name)) {
            return;
        }
        $this->blocks[$name] = $content;
    }

    /**
     * @param $name
     * @return string
     */
    public function renderBlock($name)
    {
        $block = isset($this->blocks[$name]) ? $this->blocks[$name] : null;

        if ($block instanceof \Closure) {
            return $block();
        }

        return !empty($block) ? $block: '';
    }

    /**
     * @param $name
     * @return bool
     */
    private function hasBlock($name)
    {
        return array_key_exists($name, $this->blocks);
    }

    /**
     * @param $string
     * @return string
     */
    public function encode($string)
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE);

    }

    public function __call($name, $arguments)
    {
        foreach ($this->extensions as $extension) {
            $functions = $extension->getFunctions();
            foreach ($functions as $function) {
                if ($function->name === $name) {
                    if ($function->needRenderer) {
//                        return ($function->callback)($this, ...$arguments); todo check it
                        return call_user_func($function->callback,$this, ...$arguments);

                    }
//                    return ($function->callback)(...$arguments);
                    return call_user_func($function->callback,...$arguments);
                }
            }
        }
        throw new \InvalidArgumentException('Undefined function "' . $name . '"');
    }
}
