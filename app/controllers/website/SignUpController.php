<?php

namespace app\controllers\website;

use app\controllers\AbstractPageController;
use app\routes\http\Request;
use app\services\UserService;
use app\session\Session;
use app\views\View;

/**
 * SignUp controller
 * 
 * HTML file: ./views/pages/website/html/auth/signUp.html
 * CSS file: ./views/pages/website/css/signUp.css
 * JS file: ./views/pages/website/js/signUp.js
 * 
 * @package app\controllers\website
 */ 
class SignUpController extends AbstractPageController {

    /**
     * Return the content of sign up view
     * 
     * @return string sign up rendered page
     */
    public static function getSignUp() {

        // SignUp view

        $header = View::render('pages/website/html/auth/header');

        $main = View::render('pages/website/html/auth/signUp');

        $footer = View::render('pages/website/html/auth/footer');

        // Return page view
        
        return parent::getPage('Cadastrar-se no Lemonade', $header, $main, $footer, 
        ['css' => 'app/views/pages/website/css/signUpDark.css', 'js' => 'app/views/pages/js/dist/signUp.js']);
    }


    /**
     * Register the user into the application
     * 
     * @param Request $request
     * @return array response
     */
    public static function postSignUp($request) {

        $jsonVars = $request->getJsonVars();

        $userService = new UserService();

        $user = $userService->register($jsonVars);

        if ($user) {
            
            Session::createSession($user);

            return ['message' => '', 'success' => true];

        } else {

            return ['message' => 'Erro ao cadastrar-se!', 'success' => false]; 
            
        }

    }

}
