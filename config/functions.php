<?php

use Psr\Container\ContainerInterface;

const DATA_DIRECTORY = __DIR__ . '/../data';

function getPathDataOfApplication()
{
    return DATA_DIRECTORY . DIRECTORY_SEPARATOR . getApplicationName();
}

function getPathDataOfInstance()
{
    return getPathDataOfApplication() . DIRECTORY_SEPARATOR . getInstanceId();
}

function getApplicationName()
{
    $uri = trim($_SERVER['REQUEST_URI'], '/');
    $result = explode('/', $uri);
    if (count($result) > 1) {
        return $result[1];
    }
    return false;
}

function getInstanceId()
{
    $uri = trim($_SERVER['REQUEST_URI'], '/');
    $result = explode('/', $uri);
    if (count($result) > 2) {
        return $result[2];
    }
    return false;
}


function getConnectionStringPostgres( $dsnString,array $config){
    $connectSting=$dsnString;
    $connectSting = str_replace('{host}', $config['host'],$connectSting);
    $connectSting = str_replace('{port}', $config['port'],$connectSting);
    $connectSting = str_replace('{dbname}', $config['dbname'],$connectSting);
    $connectSting = str_replace('{user}', $config['user'],$connectSting);
    $connectSting = str_replace('{password}', $config['password'],$connectSting);
    return $connectSting;
}

//----------------- only terminal use
//https://www.php.net/manual/en/features.commandline.php
function arguments($argv)
{

    $_ARG = array();

    foreach ($argv as $arg) {

        if (ereg('--([^=]+)=(.*)', $arg, $reg)) {

            $_ARG[$reg[1]] = $reg[2];

        } elseif (ereg('^-([a-zA-Z0-9])', $arg, $reg)) {

            $_ARG[$reg[1]] = 'true';

        } else {

            $_ARG['input'][] = $arg;

        }

    }

    return $_ARG;

}
