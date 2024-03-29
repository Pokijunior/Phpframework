<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Interfaces\RequestInterface;


class Request implements RequestInterface
{
    private string $uri;
    private string $method;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = strtoupper($_SERVER["REQUEST_METHOD"]);

    }

    public function Uri(): string
    {
        return $this->uri;
    }

    public function Method(): string
    {
        return $this->method;
    }
}