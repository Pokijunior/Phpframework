<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;

class Router
{
    private static $routes = [];

    public static function add($method, $uri, $callback) {
        self::$routes[] = [
            'uri' => $uri,
            'method' => $method,
            'callback' => $callback
        ];
    }
    public static function get($uri, $callback) {
        self::add('GET', $uri, $callback);
    }

    public static function post($uri, $callback) {
        self::add('POST', $uri, $callback);
    }

    public static function resolve(RequestInterface $request): ResponseInterface
    {
        $uri = $request->Uri();
        $method = $request->Method();
        var_dump($request->getParams());
        foreach (self::$routes as $route) {
            $match = Route::match($route, $uri, $method);

            if ($match) {
                return call_user_func($route['callback'], $request); //zašto request
            }
        }

        return new Response('404 Not Found');
    }
}