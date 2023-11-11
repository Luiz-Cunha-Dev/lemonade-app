<?php

use app\routes\http\Response;
use app\controllers\api\CityController;
use app\controllers\api\StateController;
use app\controllers\api\UserController;

// Cities api route

$router->get('/api/cities', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn() => new Response(200, 'application/json', CityController::getCities())
]);

// States api route

$router->get('/api/states', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn() => new Response(200, 'application/json', StateController::getStates())
]);

// User api routes

$router->get('/api/users', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn() => new Response(200, 'application/json', UserController::getAllUsers())
]);

// User api routes

$router->get('/api/user', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn($request) => new Response(200, 'application/json', UserController::getUserByParameter($request))
]);
