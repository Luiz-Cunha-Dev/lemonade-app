<?php

use app\routes\http\Response;
use app\controllers;

// Home page route
$router->get('/', [
    fn() => new Response(200, 'text/html', controllers\website\HomeController::getHome())
]);

// SignUp page route
$router->get('/signup', [
    fn() => new Response(200, 'text/html', controllers\website\SignUpController::getSignUp())
]);

// SignIn  page route
$router->get('/signin', [
    fn() => new Response(200, 'text/html', controllers\website\SignInController::getSignIn())
]);

// PhpLove route
$router->get('/php', [
    fn() => new Response(200, 'text/html', controllers\website\PhpLoveController::getPhpLove())
]);

//PhpTeste route

$router->get('/testeUser', [
    fn() => new Response(200, 'text/html', controllers\website\TesteController::getTeste())
]);
