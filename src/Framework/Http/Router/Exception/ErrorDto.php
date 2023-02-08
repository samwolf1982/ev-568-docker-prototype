<?php

namespace Framework\Http\Router\Exception;

use Exception;

class ErrorDto
{

    private $error;
    private $code;

    public function __construct(Exception $error)
    {
        $this->error = $error;
        $this->code = $error->getCode() ?: 500;
    }

    public function getError()
    {
        $obj = new \stdClass();
        $obj->code = $this->code;
        $obj->message = $this->error->getMessage();;
        $obj->line = $this->error->getLine();
        $obj->file = $this->error->getFile();
        if (method_exists($this->error, 'getType')) {
            $obj->type = $this->error->getType();
        }

        return $obj;
    }

    public function getCode()
    {
        return $this->code;
    }
}
