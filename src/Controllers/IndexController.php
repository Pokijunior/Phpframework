<?php

namespace Lovro\Phpframework\Controllers;

use Twig\Environment;
use Lovro\Phpframework\Request;
use Twig\Loader\FilesystemLoader;
use Lovro\Phpframework\Models\User;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;

class IndexController
{

    public static function indexAction(): Response
    {
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $twig = new Environment($loader);
        
        return new Response($twig->render('index.twig'));
    }

    public static function indexJsonAction(): JsonResponse
    {
        $data = ['message' => 'This is a JSON response from indexJsonAction.'];
        return new JsonResponse($data);
        }

    public static function indexSelectAction(Request $request, array $params): JsonResponse
    {
        $user = User::findById($params['id']);
        if($user === NULL) {
            return new JsonResponse(['There is no user with id: ' . $params['id']]);
        } else {
            return new JsonResponse($user->toArray());
        }
    }

    public static function indexInsertAction(): JsonResponse
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        $user = new User();
        $user->name = $requestData['users'][0]['name'];
        $user->save();
        return new JsonResponse($user->toArray());
    }


    public static function indexUpdateAction(Request $request, $params): JsonResponse
    {
        $user = User::findById($params['id']);
        if($user === NULL) {
            $user = new User();
            $user->name = $params['name'];
            $user->save($params['id'], $params['name']);
            return new JsonResponse($user->toArray());
        } else {
            $user->disableTimestamps();
            $user->name = $params['name'];
            $user->save($params['id'], $params['name']);
            return new JsonResponse($user->toArray());
        }
        
    }

    public static function indexUpdateWithTimeStampsAction(): JsonResponse
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        foreach($requestData as $data) {
            foreach($data as $unit) {
                $user = User::findById($unit['id']);
                if($user === NULL) {
                    $user = new User();
                    $user->name = $unit['name'];
                    $user->save();
                } else {
                    $user->name = $unit['name'];
                    $user->save();
                }
            }
        }
        
        return new JsonResponse(['Update with timestamps success']);
    }

    public static function indexDeleteAction(Request $request, array $params): JsonResponse
    {
        $user = User::findById($params['id']);
        if($user) {
            User::delete($params['id']);
            return new JsonResponse(['Deleted user with id: ' . $params['id']]);
        } else {
            return new JsonResponse(['User with id: ' . $params['id'] . ' does not exist']);
        }
    }
    public static function indexSofDeleteAction(Request $request, array $params): JsonResponse
    {   
        $user = User::findById($params['id']);
        if($user) {
            $user->softDelete();
            return new JsonResponse(['Soft Deleted user with id: ' . $params['id']]);
        } else {
            return new JsonResponse(['User with id: ' . $params['id'] . ' does not exist']);
        }
    }
}