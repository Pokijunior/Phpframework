<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;

class Router
{
    private static $routes = [];

    public static function addRoute($pattern, $callback)
    {
        self::$routes[$pattern] = $callback;
    }

    public static function resolve(RequestInterface $request): ResponseInterface
    {
        $url = $_SERVER['REQUEST_URI'];
        
        foreach (self::$routes as $pattern => $callback) {
            $pattern = str_replace('/', '\/', $pattern);
            
            if (preg_match('/^' . $pattern . '$/', $url, $matches)) {
                array_shift($matches);
                $content = call_user_func_array($callback, array_merge([$request], $matches));
                return $content;
            }
        }

        $content = '404 Not Found';
        return new Response($content);
    }
}