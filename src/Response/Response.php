<?php

namespace Lovro\Phpframework\Response;

use Lovro\Phpframework\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function send(): string
    {
        return $this->content;        
    }
}