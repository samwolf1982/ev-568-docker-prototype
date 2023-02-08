<?php
function getApplicationName(){
     $uri=  trim($_SERVER['REQUEST_URI'],'/');
     $result=  explode('/',$uri);
     if(count($result)>1){
         return $result[1];
     }
    return false;
}










//----------------- only terminal use
//https://www.php.net/manual/en/features.commandline.php
function arguments($argv) {

    $_ARG = array();

    foreach ($argv as $arg) {

        if (ereg('--([^=]+)=(.*)',$arg,$reg)) {

            $_ARG[$reg[1]] = $reg[2];

        } elseif(ereg('^-([a-zA-Z0-9])',$arg,$reg)) {

            $_ARG[$reg[1]] = 'true';

        } else {

            $_ARG['input'][]=$arg;

        }

    }

    return $_ARG;

}
