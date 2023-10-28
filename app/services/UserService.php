<?php 

namespace app\services;

use app\models\UserModel;

/**
 * User service
 * 
 * Responsible for reading and writing data of user entity
 * 
 * @package app\services
 */ 
class UserService extends Service {

    /**
     * Get all users
     * 
     * If it is null, returns an empty array
     * 
     * @return array users
     */
    public static function getAllUsers() {

        try {
            $users = parent::getAllElements('user');

            if (empty($user)) {
                return array();
            }

            for ($i=0; $i < count($users); $i++) { 
                $users[$i] = new UserModel($users[$i]['idUser'], $users[$i]['name'], $users[$i]['lastName'], $users[$i]['email'], $users[$i]['nickname'], $users[$i]['password'], $users[$i]['salt'],
                $users[$i]['phone'], $users[$i]['birthDate'], $users[$i]['profilePicture'], $users[$i]['street'], $users[$i]['streetNumber'], $users[$i]['district'], $users[$i]['complement'],
                $users[$i]['postalCode'], $users[$i]['firstAccess'], $users[$i]['idCity'], $users[$i]['idUserType']);
            }

            return $users;
        } catch( \Exception $e ) {
            throw $e;
        }
    }

    /**
     * Get a user by id
     * 
     * If it is null, returns an empty array
     * 
     * @param int $idUser id of the user
     * 
     * @return UserModel user
     */
    public static function getUserById($idUser){

        try{
            $user = parent::getElementByParameter('user', 'idUser', $idUser);

            if (empty($user)) {
                return array();
            }

            $user = new UserModel($user['idUser'], $user['name'], $user['lastName'], $user['email'], $user['nickname'], $user['password'], $user['salt'], 
            $user['phone'], $user['birthDate'], $user['profilePicture'], $user['street'], $user['streetNumber'], $user['district'], $user['complement'],
            $user['postalCode'], $user['firstAccess'], $user['idCity'], $user['idUserType']);

            return $user;
        } catch (\Exception $e){
            throw $e;
        }
    }

    public static function insertUser($parameters){
        try{
            parent::insertElement('user', $parameters);
            
        } catch (\Exception $e){
            throw $e;
        }
    }

    public static function updateUserById($parameters, $idUser){

        try{
            if(parent::updateElementByParameter('user', $parameters, 'idUser', $idUser)){
                return true;
            }else{
                return false;
            }
        }catch (\Exception $e){
            throw $e;
        }
    }

    public static function deleteUserById($idUser){
        
        try{

            if(parent::deleteElementByParameter('user', 'idUser', $idUser)) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e){
            throw $e;
        }
    }

    
}
