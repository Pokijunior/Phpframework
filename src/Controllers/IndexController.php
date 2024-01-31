<?php

namespace Lovro\Phpframework\Controllers;

use PDO;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Lovro\Phpframework\Connection;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;
use Lovro\Phpframework\Request;

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
        $data = ['message' => 'This is a JSON response from indexJsonAction.'];
        return new JsonResponse($data);
        }

    public static function indexSelectAction(Request $request, $params)
    {
        $connection = Connection::getInstance();
        $query = "SELECT * FROM users where id = ?";
        $values = [$params['id']];
        $result = $connection->fetchAssocAll($query, $values);
        
        return new JsonResponse($result);
    }

    public static function indexInsertAction(Request $request, $params)
    {
        $connection = Connection::getInstance();
        $query = "INSERT INTO users(id, name) VALUES (?,?)";
        $values = [$params['id'], $params['name']];
        $connection->insert($query, $values);

        return new JsonResponse("insertion success");
    }


    public static function indexUpdateAction(Request $request, $params)
    {
        $connection = Connection::getInstance();
        $query = "UPDATE users SET name = ? WHERE id = ?";
        $values = [$params['name'], $params['id']];
        $connection->update($query, $values);

        return new JsonResponse("update success");
    }
}   