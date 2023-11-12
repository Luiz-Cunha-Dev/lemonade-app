<?php

use app\controllers\webapp\AppController;
use app\controllers\webapp\LogOutController;
use app\routes\http\Response;

// Web app home page route

$router->get('/wapp', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', AppController::getApp())
]);

// LogOut page route

$router->get('/wapp/logout', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired'
    ],
    fn($request) => new Response(200, 'text/html', LogOutController::getLogOut($request))
]);
