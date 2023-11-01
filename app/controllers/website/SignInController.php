<?php

namespace app\controllers\website;

use app\views\View;
use app\services\UserService;

/**
 * SignIn  controller
 * 
 * HTML file: ./view/pages/auth/signIn.html
 * 
 * @package app\controller
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
        
        return parent::getPage('Entrar no Lemonade', $header, $main, $footer, ['css' => 'app/views/pages/website/css/signIn.css']);
    }

    /**
     * 
     * 
     * @param Request $request
     */
    public static function postSignIn($request) {

        $postVars = $request->getPostVars();

        $userService = new UserService();

        try {

            if($userService->userLogin($postVars)) {

                echo '<pre>';
                print_r($postVars);
                echo 'Logado :D';
                echo '</pre>';
            
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
