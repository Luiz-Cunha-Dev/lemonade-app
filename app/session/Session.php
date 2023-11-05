<?php

namespace app\session;

use app\models\UserModel;

/**
 * Handles user sessions in the application
 * @package app\session
 */
class Session {

    /**
     * Start a session
     */
    private static function startSession() {

        // Check if the session is active
        
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

    }

    /**
     * Creates a session for the user
     * @param UserModel $user
     * @return boolean
     */
    public static function createSession($user) {

        // Start session

        self::startSession();

        // Set user session

        $_SESSION['user'] = [
            'id' => $user->getIdUser(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];

        return true;

    }

    /**
     * Check if user has a session
     * @return boolean
     */
    public static function hasSession() {

        // Start session

        self::startSession();

        // Return if user is logged

        return isset($_SESSION['user']['id']);

    }
    
    /**
     * Destroy the user session
     * @return boolean
     */
    public static function destroySession() {

        // Start session

        self::startSession();

        // Unset user session

        unset($_SESSION['user']);

        return true;
    }

}
