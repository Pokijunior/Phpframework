<?php

namespace Lovro\Phpframework\Controllers;

use Lovro\Phpframework\Interfaces\RequestInterface;

class IndexController
{
    public function indexJsonAction(RequestInterface $request, $productId)
    {
        return ['productId' => $productId];
    }
}