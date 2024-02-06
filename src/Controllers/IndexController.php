<?php

namespace Lovro\Phpframework\Controllers;

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Lovro\Phpframework\Request;
use Lovro\Phpframework\Models\User;
use Lovro\Phpframework\Response\Response;
use Lovro\Phpframework\Response\JsonResponse;

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
        $user = User::findById($params['id']);
        if($user->toArray() === []) {
            return new JsonResponse('There is no user with id: ' . $params['id']);
        } else {
            return new JsonResponse($user->toArray());
        }
    }

    public static function indexInsertAction(Request $request)
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        $user = new User();
        $user->name = $requestData['users'][0]['name'];
        $user->save();
        return new JsonResponse($user->toArray());
    }


    public static function indexUpdateAction()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        $user = User::findById($requestData['users'][0]['id']);
        $user->name = $requestData['users'][0]['name'];
        $user->save();
        return new JsonResponse($user->toArray());
    }

    public static function indexDeleteAction(Request $request, $params)
    {
        $user = User::delete($params['id']);
        if($user) {
            return new JsonResponse('Deleted user with id: ' . $params['id']);
        } else {
            return new JsonResponse('User with id: ' . $params['id'] . ' does not exist');
        }
    }
    public static function indexSofDeleteAction(Request $request, $params)
    {
        $user = User::findById($params['id']);
        if($user) {
            $user->softDelete($params['id']);
            return new JsonResponse('Soft Deleted user with id: ' . $params['id']);
        } else {
            return new JsonResponse('User with id: ' . $params['id'] . ' does not exist');
        }
    }
}