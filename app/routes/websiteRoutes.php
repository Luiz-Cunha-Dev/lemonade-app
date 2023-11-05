<?php

use app\routes\http\Response;
use app\controllers\website\HomeController;
use app\controllers\website\SignUpController;
use app\controllers\website\SignInController;
use app\controllers\website\LogOutController;

// Home page route

$router->get('/', [
    'middlewares' => [
        'SessionLogout'
    ],
    fn() => new Response(200, 'text/html', HomeController::getHome())
]);

// SignUp page route

$router->get('/signup', [
    'middlewares' => [
        'SessionLogout'
    ],
    fn() => new Response(200, 'text/html', SignUpController::getSignUp())
]);

// SignIn page route

$router->get('/signin', [
    'middlewares' => [
        'SessionLogout'
    ],
    fn() => new Response(200, 'text/html', SignInController::getSignIn())
]);

$router->post('/signin', [
    fn($request) => new Response(200, 'text/html', SignInController::postSignIn($request))
]);

// LogOut page route

$router->get('/app/logout', [
    fn($request) => new Response(200, 'text/html', LogOutController::getLogOut($request))
]);
