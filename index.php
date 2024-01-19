<?php

require_once 'vendor/autoload.php';

use Lovro\Phpframework\Router;
use Lovro\Phpframework\Request;
use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Controllers\IndexController;


$request = new Request();

$router = new Router();

$indexController = new IndexController();

require_once 'routes.php';

$response = $router->resolve($request);
// $response = new JsonResponse($request);
$response->send();




