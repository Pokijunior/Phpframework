<?php

namespace Lovro\Phpframework\Response;

use Lovro\Phpframework\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    private array $contet;

    public function __construct(array $content)
    {
        $this->contet = $content;
    }

    public function send(): string
    {
        return json_encode($this->contet);
    }
}