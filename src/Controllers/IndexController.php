<?php

namespace Lovro\Phpframework\Controllers;

use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\HtmlResponse;
use Lovro\Phpframework\Response\JsonResponse;

class IndexController
{
    public static function indexAction($request)
    {
        return new Response('This is a normal response from indexAction.');
    }

    public static function indexJsonAction($request)
    {
        $data = ['message' => 'This is a JSON response from indexJsonAction.'];
        
        return new JsonResponse($data);
    }

    public static function indexHtmlAction($request)
    {
        $loader = new \Twig\Loader\ArrayLoader(['index' => '<p>HTML</p>']);
        $twig = new \Twig\Environment($loader);
        
        return new HtmlResponse($twig->render('index'));
    }
}