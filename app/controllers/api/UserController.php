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

        if (!(isset($queryParams['email']))) {
            return (new Response(400, 'application/json', [
                'status' => 400,
                'error' => 'Bad request',
                'message' => 'Insira um campo válido para realizar a busca'
            ]))->sendResponse();
        }

        $userService = new UserService();

        try {
            $user = $userService->getUserByEmail($queryParams['email']);
        } catch (Exception $e) {
            return (new Response(500, 'application/json', [
                'status' => 404,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ]))->sendResponse();
        }

        if (!$user) {
            return (new Response(404, 'application/json', [
                'status' => 404,
                'error' => 'Not found',
                'message' => 'O usuário não foi encontrado'
            ]))->sendResponse();
        }
        
        
        return $user->toArray();

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
            $user = $userService->getUserByNickname($queryParams['nickname']);
        } catch (Exception $e) {
            return (new Response(500, 'application/json', [
                'status' => 404,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ]))->sendResponse();
        }

        if (!$user) {
            return (new Response(404, 'application/json', [
                'status' => 404,
                'error' => 'Not found',
                'message' => 'O usuário não foi encontrado'
            ]))->sendResponse();
        }
        
        
        return $user->toArray();
    }

}