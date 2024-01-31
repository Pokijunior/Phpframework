<?php

namespace Lovro\Phpframework;


class Route {
    private $method;
    private $uri;
    private $callback;

    public function __construct($method, $uri, $callback){
        $this->method = $method;
        $this->uri = $uri;
        $this->callback = $callback;
    }

    public static function add($method, $uri, $callback) {
        Router::addRoute(new Route($method, $uri, $callback));
    }

    public static function get($uri, $callback) {
        self::add('GET', $uri, $callback);
    }

    public static function post($uri, $callback) {
        self::add('POST', $uri, $callback);
    }

    public function getUri() {
        return $this->uri;
    }
    public function getMethod() {
        return $this->method;
    }
    public function getCallback() {
        return $this->callback;
    }

    public static function match($route, $uri, $method)
    {
        $routeUriParts = explode('/', trim($route->getUri(), '/'));
        $uriParts = explode('/', trim($uri, '/'));

        if (count($routeUriParts) !== count($uriParts)) {
            return ['match' => false];
        } else {
            return self::matchParams($routeUriParts, $uriParts);
        }
    }

    public static function matchParams($routeUriParts, $uriParts) 
    {
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
