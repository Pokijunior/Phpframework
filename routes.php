<?php

use Lovro\Phpframework\Controllers\IndexController;

$router->addRoute('/', function ($request) {
    return 'Home page';
});

$router->addRoute('/contact', function ($request) {
    return 'Contact us page';
});

$router->addRoute('/about', function ($request) {
    return 'About us page';
});

$router->addRoute('/products', function ($request) {
    return 'Products page';
});

$router->addRoute('/products/(\d+)', function ($request, $productId) {
    return "Prikaz proizvoda s ID-jem: $productId";
});





// $controller = new IndexController();
// $router->addRoute('/products/{productId}', [$controller, 'indexJsonAction']);
