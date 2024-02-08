<?php

namespace Lovro\Phpframework;


class Route {
    private string $method;
    private string $uri;
    private $callback;

    public function __construct(string $method, string $uri, $callback)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->callback = $callback;
    }

    public static function add(string $method, string $uri, $callback)
    {
        Router::addRoute(new Route($method, $uri, $callback));
    }

    public static function get(string $uri, $callback): void
    {
        self::add('GET', $uri, $callback);
    }

    public static function post(string $uri, $callback): void
    {
        self::add('POST', $uri, $callback);
    }

    public function getUri(): string
    {
        return $this->uri;
    }
    public function getMethod(): string
    {
        return $this->method;
    }
    public function getCallback()
    {
        return $this->callback;
    }

    public static function match(Route $route, string $uri, string $method): array
    {
        $routeUriParts = explode('/', trim($route->getUri(), '/'));
        $uriParts = explode('/', trim($uri, '/'));

        if (count($routeUriParts) !== count($uriParts)) {
            return ['match' => false];
        } else {
            return self::matchParams($routeUriParts, $uriParts);
        }
    }

    public static function matchParams(array $routeUriParts, array  $uriParts): array
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
