<?php
use Lovro\Phpframework\Router;
use Lovro\Phpframework\Controllers\IndexController;


// Router::addRoute('/', function ($request) {
//     return 'Home page';
// });

Router::addRoute('/contact', function ($request) {
    return 'Contact us page';
});

Router::addRoute('/about', function ($request) {
    return 'About us page';
});

Router::addRoute('/products', function ($request) {
    return 'Products page';
});

Router::addRoute('/products/(\d+)', function ($request, $productId) {
    return "Prikaz proizvoda s ID-jem: $productId";
});

// Router::addRoute('/', [$indexController, 'indexAction']); //controller::class
// Router::addRoute('/json', [$indexController, 'indexJsonAction']);
Router::addRoute('/', [IndexController::class, 'indexAction']);
Router::addRoute('/json', [IndexController::class, 'indexJsonAction']);


// Router::addRoute('/products/{productId}', [$controller, 'indexJsonAction']);
