<?php
use Lovro\Phpframework\Route;
use Lovro\Phpframework\Request;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Controllers\IndexController;

// Router::get('/', function (Request $request): Response
// {
//     return new Response('Home');
// });

Route::get('/', function (Request $request): Response
{
    return new Response('Home');
});

Route::get('/products', function (Request $request): Response
{
    return new Response('Products');
});

Route::get('/products/{productId}', function (Request $request, $params): JsonResponse
{
    return new JsonResponse(
        ['Product ID' =>$params['productId']]
    );
});

Route::get('/products/{productId}/{productName}', function (Request $request, $params): JsonResponse
{
    return new JsonResponse(
        [
            'Product ID' =>$params['productId'],
            'Product Name'=>$params['productName']
        ]
    );
});

Route::get('/normal',[IndexController::class, 'indexAction']);
Route::get('/json',[IndexController::class, 'indexJsonAction']);