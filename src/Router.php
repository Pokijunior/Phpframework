<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;

class Router
{
    private static $routes = [];
    public static function addRoute($method, $uri, $callback)
    {
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'callback' => $callback
        ];
    }

    public static function get($uri, $callback) {
        self::addRoute('GET', $uri, $callback);
    }

    public static function post($uri, $callback) {
        self::addRoute('POST', $uri, $callback);
    }

    public static function resolve(RequestInterface $request): ResponseInterface
    {
        $uri = $request->Uri();
        $method = $request->Method();

        foreach (self::$routes as $route) {
            $result = Route::match($route, $uri, $method);
            if ($result['match']) {
                $params = $result['params'];
                return call_user_func($route['callback'], $request, $params);
            }
        }

        return new Response('404 Not Found');
    }
}