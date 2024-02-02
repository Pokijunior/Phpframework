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
        $query = "SELECT * FROM users where id = ? LIMIT 2";
        $values = [$params['id']];
        $result = $connection->select($query, $values)->fetchAssocAll();
        
        return new JsonResponse($result);
    }

    public static function indexInsertAction(Request $request)
    {
        $connection = Connection::getInstance();
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (isset($requestData['users']) && is_array($requestData['users'])) {
            $query = "INSERT INTO users(name) VALUES (?)";
            // $query = "INSERT INTO users(name) VALUES (:name)";
            foreach ($requestData['users'] as $user) {
                $values = [$user['name']];
                // $values = [':name' => $user['name']];
                $connection->insert($query, $values);
            }

            return new JsonResponse("Insertion success");
        } else {
            return new JsonResponse("Invalid input data");
        }
    }

    public static function indexUpdateAction()
    {
        $connection = Connection::getInstance();
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (isset($requestData['users']) && is_array($requestData['users'])) {
            $query = "UPDATE users SET name = ? WHERE id = ?";
            foreach ($requestData['users'] as $user) {
                if (isset($user['id']) && isset($user['name'])) {
                    $values = [$user['name'], $user['id']];
                    $connection->update($query, $values);
                } else {
                    return new JsonResponse("Invalid input data for update");
                }
            }

            return new JsonResponse("Update success");
        } else {
            return new JsonResponse("Invalid input data");
        }
    }
}