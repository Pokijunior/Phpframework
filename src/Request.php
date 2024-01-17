<?php

namespace Lovro\Phpframework;

use Lovro\Phpframework\Interfaces\RequestInterface;


class Request implements RequestInterface
{
    private $params;

    public function __construct()
    {
        $this->params = array_merge($_GET, $_POST);
    }

    public function getParams(): array
    {
        return $this->params;
    }
}