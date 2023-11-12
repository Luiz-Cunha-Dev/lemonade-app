<?php

namespace app\services;

use app\models\UserModel;
use app\daos\UserDAO;
use mysqli_sql_exception;

/**
 * User Service
 * 
 * Responsible for orchestrating business rules in the user context
 * 
 * @package app\services
 */ 
class UserService extends AbstractService {

    /**
     * User DAO
     * @var UserDAO $userDao
     */
    private $userDao;

    /**
     * Class constructor
     * 
     * Return a new UserService instance
     */
    public function __construct() {
        parent::__construct();
        $this->userDao = new UserDAO($this->conn->getConnection());
    }

    /**
     * Handles user register
     * @param array $userData
     */
    public function register($userData) {

        // Password encrypt

        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

        // Setting profilePicutre to null

        $temp = array_slice($userData, 0, 7);

        $temp['profilePicture'] = null;

        $userData = array_merge($temp, array_slice($userData, 7));

        $temp = array_slice($userData, 0, 13);

        // Setting firstAccess to null

        $temp['firstAccess'] = null;

        $userData = array_merge($temp, array_slice($userData, 13));

        // Setting idUser to null and idUserType to 1 (student)

        $userData = array_merge(['idUser' => null], $userData, ['idUserType' => 1]);

        $userBeforeInsert = new UserModel(...array_values($userData));

        try {

            $this->userDao->beginTransaction();

            $this->userDao->insertUser($userBeforeInsert);

            $this->userDao->commitTransaction();

            $userAfterInsert = $this->userDao->getUserByEmail($userData['email']);

            $this->userDao->closeConnection();

            return $userAfterInsert;

        } catch (mysqli_sql_exception $e) {
            $this->userDao->rollbackTransaction();
            throw $e;
        }
        
    }

    /**
     * Handles user login
     * @param array $userData
     * @return UserModel $user
     */
    public function authenticate($userData) {

        $user = $this->userDao->getUserByEmail($userData['email']);

        if (!empty($user) && !(password_verify($userData['password'], $user->toArray()['password']))) {
            $user = array();
        }

        $this->userDao->closeConnection();

        return $user;
    
    }


    /**
     * Get all users
     * @return UserModel $users
     */
    public function getAllUsers() {
        
        $user = $this->userDao->getAllUsers();

        $this->userDao->closeConnection();

        return $user;
    
    }

    /**
     * Get user by id
     * @param int $userId
     * @return UserModel $user
     */
    public function getUserById($userId) {

        $user = $this->userDao->getUserById($userId);

        $this->userDao->closeConnection();

        return $user;
    
    }

    /**
     * Get user by email
     * @param string $userEmail
     * @return UserModel $user
     */
    public function getUserByEmail($userEmail) {

        $user = $this->userDao->getUserByEmail($userEmail);

        $this->userDao->closeConnection();

        return $user;
    
    }

    /**
     * Get user by nickname
     * @param string $userNickname
     * @return UserModel $user
     */
    public function getUserByNickname($userNickname) {

        $user = $this->userDao->getUserByNickname($userNickname);

        $this->userDao->closeConnection();

        return $user;
    
    }

    /**
     * Get user by email and nickname
     * @param string $userEmail
     * @param string $userNickname
     * @return UserModel $user
     */
    public function getUserByEmailAndNickname($userEmail, $userNickname) {

        $user = $this->userDao->getUsersByParameters(['email' => $userEmail, 'nickname' => $userNickname]);

        $this->userDao->closeConnection();

        return $user;
    
    }

    /**
     * Delete user by id
     * @param integer $id
     * @return boolean
     */
    public function deleteUserbyId($idUser) {

        try {
            $this->userDao->beginTransaction();

            $deleteUser = ($this->userDao->deleteUserById($idUser));
                
            $this->userDao->commitTransaction();
            $this->userDao->closeConnection();

            return $deleteUser;

        } catch (mysqli_sql_exception $e) {
            $this-> userDao->rollbackTransaction();
            throw $e;
        }
 
    }

    /**
     * Update user by id
     * @param array $newUserData
     * @param integer $idUser
     * @return boolean
     */

    public function updateUserById($newUserData, $idUser){
        
        try {
            $this->userDao->beginTransaction();

            $updatedUser = $this->userDao->updateUserById($newUserData, $idUser);
             
            $this->userDao->commitTransaction();
            $this->userDao->closeConnection();

            return $updatedUser;

        } catch (mysqli_sql_exception $e) {
            $this->userDao->rollbackTransaction();
            throw new $e;
        }
    }

}