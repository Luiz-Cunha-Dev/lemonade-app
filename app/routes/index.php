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

$router->post('/signup', [
    fn($request) => new Response(200, 'text/html', controllers\website\SignUpController::postSignUp($request))
]);

// SignIn page route

$router->get('/signin', [
    fn() => new Response(200, 'text/html', controllers\website\SignInController::getSignIn())
]);

$router->post('/signin', [
    fn($request) => new Response(200, 'text/html', controllers\website\SignInController::postSignIn($request))
]);

// Cities api route

$router->get('/cities', [
    fn() => new Response(200, 'application/json', controllers\api\CityController::getCities())
]);

// States api route

$router->get('/states', [
    fn() => new Response(200, 'application/json', controllers\api\StateController::getStates())
]);
