<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;

class Router
{
    private $routes = [];

    public function addRoute($pattern, $callback)
    {
        $this->routes[$pattern] = $callback;
    }

    public function resolve(RequestInterface $request): ResponseInterface
    {
        $url = $_SERVER['REQUEST_URI'];
        
        foreach ($this->routes as $pattern => $callback) {
            $pattern = str_replace('/', '\/', $pattern);
            
            if (preg_match('/^' . $pattern . '$/', $url, $matches)) {
                array_shift($matches);
                $content = call_user_func_array($callback, array_merge([$request], $matches));
                return new Response($content);
            }
        }

        $content = '404 Not Found';
        return new Response($content);
    }
}