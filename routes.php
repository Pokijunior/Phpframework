<?php
use Lovro\Phpframework\Router;
use Lovro\Phpframework\Controllers\IndexController;


Router::add('GET', '/',[IndexController::class, 'indexAction']);
Router::add('GET', '/json',[IndexController::class, 'indexJsonAction']);
