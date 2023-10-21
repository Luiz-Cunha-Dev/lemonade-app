<?php 

namespace app\models;

/**
 * User model
 * 
 * Responsible for reading and writing data of user entity
 * 
 * @package app\models
 */ 
class UserModel extends Model {

    /**
     * Get all users
     * 
     * @return array users
     */
    public static function getAllUsers() {

        try {
            $users = parent::getAllElements('user');
            return $users;
        } catch( \Exception $e ) {
            throw $e;
        }
    }

    /**
     * Get a user by id
     * 
     * @param int $idUser id of the user
     * 
     * @return array user
     */
    public static function getUserById($idUser){

        try{
            $user = parent::getElementByParameter('user', 'idUser', $idUser);
            return $user;
        } catch (\Exception $e){
            throw $e;
        }
    }

}
