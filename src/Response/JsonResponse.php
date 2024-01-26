<?php

namespace Lovro\Phpframework\Response;

use Lovro\Phpframework\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    private $contet;

    public function __construct($content)
    {
        $this->contet = $content;
    }

    public function send(): string
    {
        return json_encode($this->contet);
    }
}