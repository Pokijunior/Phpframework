<?php
use Lovro\Phpframework\Route;
use Lovro\Phpframework\Request;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Controllers\IndexController;

Route::get('/', function (): Response
{
    return new Response('Home');
});

Route::get('/products', function (): Response
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

Route::get('/select/{id}',[IndexController::class, 'indexSelectAction']);

Route::post('/insert',[IndexController::class, 'indexInsertAction']);
Route::post('/update/{id}/{name}',[IndexController::class, 'indexUpdateAction']);
Route::post('/updatewithtimestamps',[IndexController::class, 'indexUpdateWithTimeStampsAction']);
Route::post('/delete/{id}',[IndexController::class, 'indexDeleteAction']);
Route::post('/softdelete/{id}',[IndexController::class, 'indexSofDeleteAction']);