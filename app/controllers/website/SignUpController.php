<?php

namespace app\controllers\website;

use app\views\View;

/**
 * SignUp controller
 * 
 * HTML file: ./view/pages/auth/signUp.html
 * 
 * @package app\controller
 */ 
class SignUpController extends WebsitePageController {

    /**
     * Return the content of sign up view
     * 
     * @return string sign up rendered page
     */
    public static function getSignUp() {

        // SignUp view

        $header = View::render('website/html/auth/header');

        $main = View::render('website/html/auth/signup');

        $footer = View::render('website/html/auth/footer');

        // Return page view
        
        return parent::getPage('Cadastrar-se no Lemonade', $header, $main, $footer, ['css' => 'app/views/pages/website/css/signupDark.css', 'js' => 'app/views/pages/website/js/dist/signup.js']);
    }

    /**
     * 
     * 
     * @param Request $request
     */
    public static function postSignUp() {
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
