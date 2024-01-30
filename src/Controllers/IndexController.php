<?php

namespace Lovro\Phpframework\Controllers;

use PDO;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Lovro\Phpframework\Connection;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;

class IndexController
{
    private $db;

    public static function indexAction($request)
    {
        $loader = new ArrayLoader(['index' => '<p>TWIG</p>']);
        $twig = new Environment($loader);
        
        return new Response($twig->render('index'));
    }

    public static function indexJsonAction($request)
    {

        if($connection = Connection::getInstance()) 
        {
            $query = "SELECT * FROM users where id = ?";
            $values = [$_GET['id']];
            $result = $connection->select($query, $values)->fetchAll();
            
            // $query = "INSERT INTO users(id, name) VALUES (?,?)";
            // $values = [$_GET['id'], $_GET['name']];
            // $connection->insert($query, $values);
            
            
            return new JsonResponse($result);
        } else {
            return new JsonResponse("This is JSON response");
        }
    }
}   