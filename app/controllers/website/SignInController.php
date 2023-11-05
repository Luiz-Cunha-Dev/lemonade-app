<?php

namespace app\controllers\website;

use app\controllers\AbstractPageController;
use app\models\UserModel;
use app\routes\http\Request;
use app\views\View;
use app\services\UserService;
use app\session\Session;
use Exception;

/**
 * SignIn  controller
 * 
 * HTML file: ./view/pages/website/html/auth/signIn.html
 * CSS file: ./view/pages/website/css/signIn.css
 * 
 * @package app\controllers\website
 */ 
class SignInController extends AbstractPageController {

    /**
     * Return the content of sign in view
     * 
     * @return string sign in rendered page
     */
    public static function getSignIn($request) {

        // Get the remember me cookie if it exists

        $rememberMeCookie = self::hasRememberMeCookie();

        if ($rememberMeCookie) {

            $userService = new UserService();

            // Cookie validation

            if (self::validateRememberMeCookie($rememberMeCookie)) {    

                $userId = self::getUserIdFromRememberMeCookie($rememberMeCookie);
                Session::createSession($userService->getUserById($userId));
                $request->getRouter()->redirect('/app');

            }

        }

        // SignIn view

        $header = View::render('website/html/auth/header');

        $main = View::render('website/html/auth/signIn');

        $footer = View::render('website/html/auth/footer');

        // Return page view
        
        return parent::getPage('Entrar no Lemonade', $header, $main, $footer, 
        ['css' => 'app/views/pages/website/css/signInDark.css', 'js' => 'app/views/pages/website/js/dist/signIn.js']);
    }

    /**
     * Logs the user into the application
     * 
     * @param Request $request
     * @return void logs the user in and redirects
     */
    public static function postSignIn($request) {

        $postVars = $request->getPostVars();

        $userService = new UserService();

        try {

            $user = $userService->authenticate($postVars);

            // Create the remember me cookie
            
            if (isset($postVars['rememberme']) && $postVars['rememberme'] == 'on') {
                self::createRememberMeCookie($user);
            }

            Session::createSession($user);

            $request->getRouter()->redirect('/app');

        } catch (Exception $e) {
            echo '<pre>';
            echo 'Error: '. $e->getMessage();
            echo '<br>';
            echo 'Code: '. $e->getCode();
            echo '</pre>';
            exit;
        }
        
    }

    /**
     * Create remember me cookie
     * @param UserModel $user
     */
    private static function createRememberMeCookie($user) {
        $token = random_bytes(32);
        $cookie = $user->getIdUser() . ':' . $token;
        $mac = hash_hmac('sha256', $cookie, 'lemonade');
        $cookie .= ':' . $mac;
        setcookie('rememberme', $cookie);
    }

    /**
     * Check if has a remember me cookie
     */
    private static function hasRememberMeCookie() {
        return isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    }

    /**
     * Validate the remember me cookie
     * @param string $cookie remember me cookie
     * @return boolean
     */
    private static function validateRememberMeCookie($cookie) {
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
    private static function getUserIdFromRememberMeCookie($cookie) {
        $userId = explode(':', $cookie)[0];
        return $userId;
    }

}
