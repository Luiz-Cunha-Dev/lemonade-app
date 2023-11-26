<?php

namespace app\controllers\api;

use app\routes\http\Request;
use app\routes\http\Response;
use app\services\UserService;
use app\utils\FileHandler;
use Exception;

/**
 * User controller
 * 
 * @package app\controllers\api
 */ 
class UserController {

    /**
     * Get user all users
     * @param Request $request
     * @return array $users
     */
    public static function getAllUsers($request) {

        $queryParams = $request->getQueryParams();

        $userService = new UserService();

        try {

            if (isset($queryParams['count']) && $queryParams['count'] == 'true') {

                $users = $userService->countAllUsers();

            } elseif (!isset($queryParams['offset']) && !isset($queryParams['limit'])) {
            
                $users = $userService->getAllUsers();

                $users = array_map(function($user) {
                    $user = $user->toArray();
                    unset($user['password']);
                    return $user;
                }, (array)$users);

            } else {

                // Pagination

                $users = $userService->getAllUsersWithPagination($queryParams['offset'] ?? null, $queryParams['limit'] ?? null);

                $users = array_map(function($user) {
                    $user = $user->toArray();
                    unset($user['password']);
                    unset($user['rowNumber']);
                    return $user;
                }, (array)$users);
            
            }

            if (!$users) {
                return (new Response(204, 'application/json', []))->sendResponse();
            }

            if (isset($queryParams['admin']) && $queryParams['admin'] == 'false') {
                $users = array_filter($users, function($user) {
                    return $user['idUserType'] == 1;
                });
            
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
     * @param Request $request
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
     * Update user by id
     * @param Request $request
     * @param integer $idUser
     * @return boolean
     */
    public static function updateUserById($request, $idUser){
        
        $jsonVars = $request->getJsonVars();

        try {

            $userService = new UserService();
            $updatedUser = $userService->updateUserById($jsonVars, $idUser);

            if (!$updatedUser) {
                return (new Response(404, 'application/json', ['message' => 'Usuário não encontrado!', 'success' => false]))->sendResponse();
            }

            return (new Response(204, 'application/json', ['message' => 'Usuário atualizado com sucesso!', 'success' => true]))->sendResponse();

        } catch (Exception $e) {

            return (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Erro interno do servidor',
                'message' => $e->getMessage()
            ]))->sendResponse();

        }

    }

    /**
     * Update user profile picture by id
     * @param Request $request
     * @param integer $idUser
     * @return boolean
     */
    public static function updateUserProfilePictureById($request, $idUser){
        
        $file = $request->getFiles()['file'];

        try {

            $userService = new UserService();

            $userNickname = $userService->getUserById($idUser)->getNickname();

            if (!$userNickname) {
                return (new Response(404, 'application/json', ['message' => 'Usuário não encontrado!', 'success' => false]))->sendResponse();
            }

            if (!FileHandler::handleFile($file, $userNickname)) {
                return (new Response(400, 'application/json', ['message' => 'Erro ao fazer uploado do arquivo!', 'success' => false]))->sendResponse();
            }

            $profilePicture = FileHandler::getProfilePicturePath($file, $userNickname) . "." . FileHandler::getFileExtension($file['name'], $userNickname);

            (new UserService())->updateUserById(['profilePicture' => $profilePicture], $idUser);

            return (new Response(204, 'application/json', ['message' => 'Usuário atualizado com sucesso!', 'success' => true]))->sendResponse();

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
     * @param integer $idUser
     * @return boolean
     */
    public static function deleteUserById($idUser){

        try {
            $userService = new UserService();
            $deletedUser = $userService->deleteUserById($idUser);

            if (!$deletedUser) {
                return (new Response(204, 'application/json', ['message' => 'Usuário não encontrado!', 'success' => false]))->sendResponse();
            }

            return (new Response(204, 'application/json', ['message' => 'Usuário deletado com sucesso!', 'success' => true]))->sendResponse();

        } catch (Exception $e) {

            (new Response(500, 'application/json', [
                'status' => 500,
                'error' => 'Erro interno do servidor',
                'message' => $e->getMessage()
            ]))->sendResponse();  

        }
    }

}