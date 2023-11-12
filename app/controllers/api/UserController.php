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
                    $user = $user->toArray();
                    unset($user['password']);
                    return $user;
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

            } elseif (isset($queryParams['email'])) {

                $user = $userService->getUserByEmail($queryParams['email']);

            } elseif (isset($queryParams['nickname'])) {

                $user = $userService->getUserByNickname($queryParams['nickname']);
                
            } else {

                return (new Response(204, 'application/json', []))->sendResponse();

            }

            if (isset($user) && $user) {
                $user = $user->toArray();
                unset($user['password']);
                $user = [$user];
            } else {
                return $user = array();
            }

            return $user;

        } catch (Exception $e) {
            return (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Erro interno do servidor',
                'message' => $e->getMessage()
            ]))->sendResponse();
        }

    }

    /**
     * Delete user by id
     * 
     * @return boolean
     */
    public static function deleteUserById($id){

        try {
            $userService = new UserService;
            $deletedUser = $userService->deleteUserById($id);

            if($deletedUser){
                return [
                    'message' => 'Usuário deletado',
                    'success' => 'true'
                ];
            }

            return (new Response(404, 'application/json', [
                'message' => 'Usuário não encontrado',
                'success' => 'false'

            ]))->sendResponse();

        } catch (\Exception $e) {

            (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Erro interno do servidor',
                'message' => $e->getMessage()
            ]))->sendResponse();  

        }
    }
    /**
     * Update user by id
     * 
     * @return boolean
     */
    public static function updateUserById($request, $idUser){
        
        $jsonvars = $request->getJsonVars();

        try {
            $userService = new UserService;
            $updatedUser = $userService->updateUserById($jsonvars, $idUser);

            if($updatedUser){
                return [
                    'message' => 'Usuario atualizado',
                    'success' => 'true'
                ];
            }

            return [
                'message' => 'Usuario não encontrado',
                'success' => 'false'
            ];
        } catch (\Exception $e) {
            throw new $e;
        }
    }

}