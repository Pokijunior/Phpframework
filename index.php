<?php

require_once 'vendor/autoload.php';
require_once 'routes.php';


use Lovro\Phpframework\Router;
use Lovro\Phpframework\Request;

$request = new Request();

echo Router::resolve($request)->send();



