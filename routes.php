<?php
use Lovro\Phpframework\Router;
use Lovro\Phpframework\Request;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Controllers\IndexController;

Router::add('GET', '/', function (Request $request): Response
{
    return new Response('Home');
});

Router::add('GET', '/products', function (Request $request): Response
{
    return new Response('Products');
});


Router::add('GET', '/normal',[IndexController::class, 'indexAction']);
Router::add('GET', '/json',[IndexController::class, 'indexJsonAction']);
