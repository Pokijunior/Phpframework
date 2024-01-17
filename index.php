<?php

require_once 'vendor/autoload.php';

use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Router;
use Lovro\Phpframework\Request;


$request = new Request();

$router = new Router();


require_once 'routes.php';

$response = $router->resolve($request);
// $response = new JsonResponse($request);
$response->send();




