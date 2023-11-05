<?php

namespace app\controllers\website;

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
class SignInController extends WebsitePageController {

    /**
     * Return the content of sign in view
     * 
     * @return string sign in rendered page
     */
    public static function getSignIn() {

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

            $user = $userService->login($postVars);

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

}
