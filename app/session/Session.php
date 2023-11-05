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

        // Destroy session cookie

        self::destroySessionCookie();

        // Destroy remember me cookie

        self::destroyRememberMeCookie();

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

    /**
     * Destroy session cookie
     */
    private static function destroySessionCookie() {
        setcookie('PHPSESSID', '', time()-3600, '/'); 
        unset($_COOKIE['PHPSESSID']);
    }

    /**
     * Create remember me cookie
     * @param UserModel $user
     */
    public static function createRememberMeCookie($user) {
        $token = random_bytes(32);
        $cookie = $user->getIdUser() . ':' . $token;
        $mac = hash_hmac('sha256', $cookie, 'lemonade');
        $cookie .= ':' . $mac;
        setcookie('rememberme', $cookie);
    }

    /**
     * Check if has a remember me cookie
     */
    public static function hasRememberMeCookie() {
        return isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    }

    /**
     * Validate the remember me cookie
     * @param string $cookie remember me cookie
     * @return boolean
     */
    public static function validateRememberMeCookie($cookie) {
        list ($user, $token, $mac) = explode(':', $cookie);
        if (!hash_equals(hash_hmac('sha256', $user . ':' . $token, 'lemonade'), $mac)) {
            return false;
        }
        return true;
    }

    /**
     * Get user id from remember me cookie
     * @param string $cookie remember me cookie
     * @return int user id
     */
    public static function getUserIdFromRememberMeCookie($cookie) {
        $userId = explode(':', $cookie)[0];
        return $userId;
    }

    /**
     * Destroy remember me cookie
     */
    private static function destroyRememberMeCookie() {
        setcookie('rememberme', '', time()-3600, '/lemonade'); 
        unset($_COOKIE['rememberme']);
    }

}
