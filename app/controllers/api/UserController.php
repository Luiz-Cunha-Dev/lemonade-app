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
     * Get user all users
     * 
     * @return array $users
     */
    public static function getAllUsers() {

        $userService = new UserService();

        try {
            
            $users = $userService->getAllUsers();

                $users = array_map(function($user) {
                    return $user->toArray();
                }, (array)$users);

            
            if (!$users) {
                return (new Response(204, 'application/json', []))->sendResponse();
            }

            return $users;

        } catch (Exception $e) {
            return (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Erro interno do servidor',
                'message' => $e->getMessage()
            ]))->sendResponse();
        }

    }

    /**
     * Get user by query parameter
     * 
     * @return array $user
     */
    public static function getUserByParameter($request) {

        $queryParams = $request->getQueryParams();

        $userService = new UserService();

        try {
            
            if (isset($queryParams['email']) && isset($queryParams['nickname'])) {

                $user = $userService->getUserByEmailAndNickname($queryParams['email'], $queryParams['nickname']);

            } else if (isset($queryParams['email'])) {

                $user = $userService->getUserByEmail($queryParams['email']);

            } else if (isset($queryParams['nickname'])) {

                $user = $userService->getUserByNickname($queryParams['nickname']);
                
            } else {

                return (new Response(204, 'application/json', []))->sendResponse();

            }

            return (isset($user) && $user) ? $user->toArray() : array();

        } catch (Exception $e) {
            return (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Erro interno do servidor',
                'message' => $e->getMessage()
            ]))->sendResponse();
        }

    }

}
