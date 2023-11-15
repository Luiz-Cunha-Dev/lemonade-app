<?php

use app\controllers\webapp\FirstAccessController;
use app\controllers\webapp\LogOutController;
use app\controllers\webapp\RankingController;
use app\controllers\webapp\WappController;
use app\routes\http\Response;

// Web app home page route

$router->get('/wapp', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', WappController::getWapp())
]);

// Web app first access page route

$router->get('/wapp/firstAccess', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', FirstAccessController::getFirstAccess())
]);

// Web app ranking page route

$router->get('/wapp/ranking', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', RankingController::getRanking())
]);

// LogOut page route

$router->get('/wapp/logout', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired'
    ],
    fn($request) => new Response(200, 'text/html', LogOutController::getLogOut($request))
]);
