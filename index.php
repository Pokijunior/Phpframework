<?php

require_once 'vendor/autoload.php';

use Lovro\Phpframework\Router;
use Lovro\Phpframework\Request;

$request = new Request();

require_once 'routes.php';

echo Router::resolve($request)->send();



