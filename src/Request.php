<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Interfaces\RequestInterface;


class Request implements RequestInterface
{
    private string $uri;
    private string $method;
    private $params;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = strtoupper($_SERVER["REQUEST_METHOD"]);
        $this->params = $this->parseParams();

    }

    public function Uri(): string
    {
        return $this->uri;
    }

    public function Method(): string
    {
        return $this->method;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    private function parseParams() 
    {
        $urlParts = explode('/', trim($this->uri, '/'));
        // array_shift($urlParts);
        return $urlParts;
    }
}