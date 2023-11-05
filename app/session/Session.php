<?php

namespace app\session;

use app\models\UserModel;

/**
 * Handles user sessions in the application
 * @package app\session
 */
class Session {

    /**
     * Session expiration time (minutes)
     * @var float
     */
    private static $expireAfter = 30;

    /**
     * Start a session
     */
    private static function startSession() {

        // Check if the session is active
        
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start([
                'use_only_cookies' => 1,
                'cookie_lifetime' => 0,
                'cookie_secure' => 1,
                'cookie_httponly' => 1
              ]);
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
            'userType' => $user->getIdUserType(),
            'lastAction' => time()
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

    /**
     * Get current user session data
     * @return array $userData
     */
    public static function getCurrentUserSessionData() {

        // Start session

        self::startSession();

        // Update lastAction

        self::updateUserSessionLastAction();

        // Return user session data

        return $_SESSION['user'];

    }

    /**
     * Check if user session has expired
     * 
     * If the session has expired, destroy it
     * @return boolean
     */
    public static function checkIfSessionExpired() {

        // Start session

        self::startSession();

        // Check if user has a session (with lastAction)

        if (isset($_SESSION['user']['lastAction'])) {

            // Seconds inactive

            $secondsInactive = time() - $_SESSION['user']['lastAction'];
        
            // Minutes to seconds

            $expireAfterSeconds = self::$expireAfter * 60;
        
            // Check if he has not been active for too long

            if ($secondsInactive >= $expireAfterSeconds) {

                // Destroy the session 

                self::destroySession();
                return true;
            }

            // Update lastAction

            self::updateUserSessionLastAction();

        }

        return false;

    }

    /**
     * Update user session last action
     */
    public static function updateUserSessionLastAction() {

        // Start session

        self::startSession();

        // Update lastAction

        $_SESSION['user']['lastAction'] = time();

    }

}
