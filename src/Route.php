<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;


class Route {

    public static function add($method, $uri, $callback) {
        Router::addRoute($method, $uri, $callback);
    }

    public static function match($route, $uri, $method)
    {
        if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
            return true;
        } else {
            return false;
        }
    }

    public static function matchParams($routeUri, $uriParts, $params)
    {
        if (count((array)$routeUri) != count($uriParts)) {
            return false;
        }

        $params = [];

        for ($i = 0; $i < count($uriParts); $i++) {

            if ($uriParts[$i][0] === '{' && $uriParts[$i][strlen($uriParts[$i])-1] === '}') {
                $paramName = trim($uriParts[$i], '{}');
                $params[$paramName] = $routeUri[$i];
                continue;
            }

            if ($uriParts[$i]!== $routeUri[$i]) {
                return false;
            }
        }

        return true;
    }
}