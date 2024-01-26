<?php

namespace Lovro\Phpframework;


class Route {

    public static function add($method, $uri, $callback) {
        Router::addRoute($method, $uri, $callback);
    }

    public static function match($route, $uri, $method)
    {
        $routeUriParts = explode('/', trim($route['uri'], '/'));
        $uriParts = explode('/', trim($uri, '/'));

        if (count($routeUriParts) !== count($uriParts)) {
            return ['match' => false];
        }

        $params = [];
        foreach ($routeUriParts as $key => $part) {
            if ($part !== $uriParts[$key] && strpos($part, '{') === false) {
                return ['match' => false];
            }

            if (strpos($part, '{') !== false) {
                $paramName = trim($part, '{}');
                $params[$paramName] = $uriParts[$key];
            }
        }

        return [
            'match' => true,
            'params' => $params,
        ];
    }
}