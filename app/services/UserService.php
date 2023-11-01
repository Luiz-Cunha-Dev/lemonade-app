<?php

namespace app\services;

use app\models\UserModel;
use app\DAOs\UserDAO;

/**
 * User Service
 * 
 * Responsible for orchestrating business rules in the user context
 * 
 * @package app\services
 */ 
class UserService extends Service {

    /**
     * 
     * @param array $userData
     */
    public function userRegister($userData) {
        
        if (!($userData['password'] == $userData['confirmPassword'])) {
            throw new \Exception('Passwords don\'t match');
        
        }

        unset($userData['confirmPassword']);

        unset($userData['state']);

        $userData['complement'] = $userData['state'] ? $userData['state'] : null;

        // $cityDAO = new CityDAO($this->conn->getConnection());
        
        // $userData['idCity'] = // cityDAO->getCityByName($userData['city'])->getId();

        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

        $userData = array_merge(['idUser' => null], $userData, ['idUserType' => 1]);

        $user = new UserModel(...array_values($userData));

        $userDao = new UserDAO($this->conn->getConnection());

        $userDao->insertUser($user);
        
    }

    /**
     * 
     * @param array $userData
     */
    public function userLogin($userData) {

        $userDao = new UserDAO($this->conn->getConnection());

        $user = $userDao->getUserByEmail($userData['email']);

        if (!$user) {
            throw new \Exception('User not found');
        }

        if (!(password_verify($userData['password'], $user->getPassword()))) {
            throw new \Exception('Incorrect Password');
        }

        return true;
    
    }

}
