<?php

namespace app\controllers\api;

use app\routes\http\Response;
use app\services\UserService;
use Exception;

/**
 * User controller
 * 
 * @package app\controllers\api
 */ 
class UserController {

    /**
     * Get user by email
     * 
     * @return array $user
     */
    public static function getUserByEmail($request) {

        $queryParams = $request->getQueryParams();

        if (!(isset($queryParams['email'])) && !(isset($queryParams['nickname']))) {
            return (new Response(400, 'application/json', [
                'status' => 400,
                'error' => 'Bad request',
                'message' => 'Insira um campo válido para realizar a busca'
            ]))->sendResponse();
        }

        $userService = new UserService();

        try {
            if (isset($queryParams['email'])) $user = $userService->getUserByEmail($queryParams['email']);
            if (isset($queryParams['nickname'])) $user = $userService->getUserByNickname($queryParams['nickname']);
            return $user->toArray();
        } catch (Exception $e) {
            return (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ]))->sendResponse();
        }

    }

    /**
     * Get user by nickname
     * 
     * @return array $user
     */
    public static function getUserByNickname($request) {

        $queryParams = $request->getQueryParams();

        if (!(isset($queryParams['nickname']))) {
            return (new Response(400, 'application/json', [
                'status' => 400,
                'error' => 'Bad request',
                'message' => 'Insira um campo válido para realizar a busca'
            ]))->sendResponse();
        }

        $userService = new UserService();

        try {
            return ($userService->getUserByNickname($queryParams['nickname']))->toArray();
        } catch (Exception $e) {
            return (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ]))->sendResponse();
        }
        
    }

}