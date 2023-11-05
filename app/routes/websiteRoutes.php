<?php

use app\routes\http\Response;
use app\controllers\website\HomeController;
use app\controllers\website\SignUpController;
use app\controllers\website\SignInController;

// Home page route

$router->get('/', [
    'middlewares' => [
        'RequireSessionLogout'
    ],
    fn() => new Response(200, 'text/html', HomeController::getHome())
]);

// SignUp page route

$router->get('/signup', [
    'middlewares' => [
        'RequireSessionLogout'
    ],
    fn() => new Response(200, 'text/html', SignUpController::getSignUp())
]);

// SignIn page route

$router->get('/signin', [
    'middlewares' => [
        'RequireSessionLogout'
    ],
    fn($request) => new Response(200, 'text/html', SignInController::getSignIn($request))
]);

$router->post('/signin', [
    fn($request) => new Response(200, 'text/html', SignInController::postSignIn($request))
]);
