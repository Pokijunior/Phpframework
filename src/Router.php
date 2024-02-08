<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Route;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;

class Router
{
    private static array $routes = [];
    public static function addRoute(Route $route): void
    {
        self::$routes[] = $route;
    }
    
    public static function resolve(RequestInterface $request): ResponseInterface
    {
        $uri = parse_url($request->Uri())['path'];
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