<?php

namespace Framework\Infrastructure\DtoContainers;

use ErrorException;
use Exception;

class ErrorDto
{

    private $error;
    public function __construct(Exception $error)
    {
        $this->error=$error;
    }
    public function getError(){
        $obj=new \stdClass();
        $obj->code= $this->error->getCode();
        $obj->message=  $this->error->getMessage();;
        $obj->line= $this->error->getLine();
        $obj->file= $this->error->getFile();
        if(method_exists($this->error,'getType')){
            $obj->type= $this->error->getType();
        }

        return $obj;
    }
    public function getCode(){
        return $this->error->getCode();
    }
}
