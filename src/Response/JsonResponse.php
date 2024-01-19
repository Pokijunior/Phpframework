<?php

namespace Lovro\Phpframework\Response;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Interfaces\RequestInterface;
use Lovro\Phpframework\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function send(): string
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
        return json_encode($this->data);
    }
}