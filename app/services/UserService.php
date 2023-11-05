<?php

namespace app\services;

use app\models\UserModel;
use app\daos\UserDAO;
use Exception;

/**
 * User Service
 * 
 * Responsible for orchestrating business rules in the user context
 * 
 * @package app\services
 */ 
class UserService extends Service {

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

        $user = new UserModel(...array_values($userData));

        $userDao = new UserDAO($this->conn->getConnection());

        $userDao->insertUser($user);
        
    }

    /**
     * Handles user login
     * @param array $userData
     * @return UserModel $user
     */
    public function login($userData) {

        $userDao = new UserDAO($this->conn->getConnection());

        $user = $userDao->getUserByEmail($userData['email']);

        if (!$user) {
            throw new Exception('User not found', 400);
        }

        if (!(password_verify($userData['password'], $user->getPassword()))) {
            throw new Exception('Incorrect Password', 400);
        }

        return $user;
    
    }

}
