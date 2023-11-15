<?php

namespace app\controllers\website;

use app\controllers\AbstractPageController;
use app\routes\http\Request;
use app\views\View;
use app\services\UserService;
use app\session\Session;

/**
 * SignIn  controller
 * 
 * HTML file: ./views/pages/website/html/auth/signIn.html
 * CSS file: ./views/pages/style/signIn.css
 * JS file: ./views/pages/js/dist/signIn.js
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

        $rememberMeCookie = Session::hasRememberMeCookie();

        if ($rememberMeCookie) {

            $userService = new UserService();

            // Cookie validation

            if (Session::validateRememberMeCookie($rememberMeCookie)) {    

                $userId = Session::getUserIdFromRememberMeCookie($rememberMeCookie);
                Session::createSession($userService->getUserById($userId));
                $request->getRouter()->redirect('/wapp');

            }

        }

        // SignIn view

        $header = View::render('pages/website/html/auth/header');

        $main = View::render('pages/website/html/auth/signIn');

        $footer = View::render('pages/website/html/auth/footer');

        // Return page view
        
        return parent::getPage('Entrar no Lemonade', $header, $main, $footer, 
        ['css' => './app/views/pages/style/signIn.css', 'js' => './app/views/pages/js/dist/signIn.js']);
    }

    /**
     * Logs the user into the application
     * 
     * @param Request $request
     * @return array response
     */
    public static function postSignIn($request) {

        $postVars = $request->getJsonVars();

        $userService = new UserService();

        $user = $userService->authenticate($postVars);

        if ($user) {

            // Create the remember me cookie
            
            if (isset($postVars['rememberme']) && $postVars['rememberme'] == 'on') {
                Session::createRememberMeCookie($user);
            }

            Session::createSession($user);

            return ['message' => '', 'success' => true]; 

        } else {

            return ['message' => 'E-mail ou senha incorretos!', 'success' => false]; 

        }
        
    }

}