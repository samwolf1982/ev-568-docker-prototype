<?php
function getApplicationName(){
     $uri=  trim($_SERVER['REQUEST_URI'],'/');
     $result=  explode('/',$uri);
     if(count($result)>1){
         return $result[1];
     }
    return false;
}