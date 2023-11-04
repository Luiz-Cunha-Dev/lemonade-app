<?php

namespace app\controllers\website;

use app\views\View;
use app\services\UserService;

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

        $main = View::render('website/html/auth/signin');

        $footer = View::render('website/html/auth/footer');

        // Return page view
        
        return parent::getPage('Entrar no Lemonade', $header, $main, $footer, ['css' => 'app/views/pages/website/css/signinDark.css', 'js' => 'app/views/pages/website/js/dist/signin.js']);
    }

    /**
     * 
     * 
     * @param Request $request
     */
    public static function postSignIn() {
        $body = file_get_contents('php://input');
        $postVars = json_decode($body, true);

        try {
            // Processar os dados
            // ...
    
            header('Content-Type: application/json');
            return json_encode($postVars);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
