<?php

use app\controllers\webapp\LogOutController;
use app\controllers\webapp\WappController;
use app\routes\http\Response;

// Web app home page route

$router->get('/wapp', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired'
    ],
    fn() => new Response(200, 'text/html', WappController::getWapp())
]);

// LogOut page route

$router->get('/wapp/logout', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired'
    ],
    fn($request) => new Response(200, 'text/html', LogOutController::getLogOut($request))
]);
