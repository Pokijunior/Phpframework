<?php

require_once 'vendor/autoload.php';

use Lovro\Phpframework\Router;
use Lovro\Phpframework\Request;
use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Controllers\IndexController;


$request = new Request(); //ostaje

// $router = new Router(); //mjenjaj u statičnu metodu

$indexController = new IndexController();

require_once 'routes.php';

// $response = $router->resolve($request); //Router::resolve
$response = Router::resolve($request);

// fali echo
// $response->send();
echo Router::resolve($request)->send();



