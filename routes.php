<?php
use Lovro\Phpframework\Route;
use Lovro\Phpframework\Request;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Controllers\IndexController;

Route::add('GET', '/', function (Request $request): Response
{
    return new Response('Home');
});

Route::add('GET', '/products', function (Request $request): Response
{
    return new Response('Products');
});

Route::add('GET', '/products/{productId}', function (Request $request, $params): JsonResponse
{
    return new JsonResponse(
        ['Product ID' =>$params['productId']]
    );
});

Route::add('GET', '/normal',[IndexController::class, 'indexAction']);
Route::add('GET', '/json',[IndexController::class, 'indexJsonAction']);
