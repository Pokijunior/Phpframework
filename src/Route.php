<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;


class Route {

    public static function match($route, $uri, $method)
    {
        if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
            return true;
        } else {
            return false;
        }
    }
}