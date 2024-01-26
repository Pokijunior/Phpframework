<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;

class Router
{
    private static $routes = [];
    public static function addRoute(Route $route)
    {
        self::$routes[] = $route;
    }

    public static function resolve(RequestInterface $request): ResponseInterface
    {
        $uri = $request->Uri();
        $method = $request->Method();

        foreach (self::$routes as $route) {
            $result = Route::match($route, $uri, $method);
            if ($result['match']) {
                $params = [$request, $result['params']];
                return call_user_func_array($route->getCallback(), $params); //
            }
        }

        return new Response('404 Not Found');
    }
}