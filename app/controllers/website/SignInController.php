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
 * HTML file: ./views/pages/website/html/auth/signIn.html
 * CSS file: ./views/pages/website/css/signIn.css
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
                $request->getRouter()->redirect('/app');

            }

        }

        // SignIn view

        $header = View::render('pages/website/html/auth/header');

        $main = View::render('pages/website/html/auth/signIn', [
            'alert' => ''
        ]);

        $footer = View::render('pages/website/html/auth/footer');

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
                Session::createRememberMeCookie($user);
            }

            Session::createSession($user);

            $request->getRouter()->redirect('/app');

        } catch (Exception $e) {

        $header = View::render('pages/website/html/auth/header');

        $main = View::render('pages/website/html/auth/signIn', [
            'alert' => View::render('components/alert', [
                'alertType' => 'warning',
                'errorType' => 'Erro ao fazer login',
                'message' => $e->getMessage()
            ])
        ]);

        $footer = View::render('website/html/auth/footer');

        return parent::getPage('Entrar no Lemonade', $header, $main, $footer, 
        ['css' => 'app/views/pages/website/css/signInDark.css', 'js' => 'app/views/pages/website/js/dist/signIn.js']);

        }
        
    }

}
