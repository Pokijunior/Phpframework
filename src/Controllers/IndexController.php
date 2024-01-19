<?php

namespace Lovro\Phpframework\Controllers;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;

class IndexController
{
    public function indexAction($request)
    {
        return new Response('This is a regular response from indexAction.');
    }

    public function indexJsonAction($request)
    {
        $data = ['message' => 'This is a JSON response from indexJsonAction.'];
        return new JsonResponse($data);
    }
}