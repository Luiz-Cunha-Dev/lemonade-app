<?php

use app\controllers\webapp\QuestionController;
use app\controllers\webapp\AppController;
use app\controllers\webapp\EditAccountController;
use app\controllers\webapp\ExamController;
use app\controllers\webapp\ExamsController;
use app\controllers\webapp\FirstAccessController;
use app\controllers\webapp\LogOutController;
use app\controllers\webapp\RankingController;
use app\controllers\webapp\TrainController;
use app\controllers\webapp\UsersController;
use app\routes\http\Response;

use app\daos\QuestionAlternativeDAO;

// Web app home page route

$router->get('/wapp', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', AppController::getApp())
]);

// Web app first access page route

$router->get('/wapp/firstAccess', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', FirstAccessController::getFirstAccess())
]);

// Web app ranking page route

$router->get('/wapp/ranking', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', RankingController::getRanking())
]);

// Web app users page route

$router->get('/wapp/users', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', UsersController::getUsers())
]);

// Web app train page route

$router->get('/wapp/train', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', TrainController::getTrain())
]);

// Web app exams page route

$router->get('/wapp/exams', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', ExamsController::getExams())
]);

// Web app exam page route

$router->get('/wapp/exam', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', ExamController::getExam())
]);

// Web app editAccount page route

$router->get('/wapp/editAccount', [
    'middlewares' => [
        'RequireSessionLogin',
        'IsSessionExpired',
        'SessionRefresh',
        'IsSessionFirstAccess'
    ],
    fn() => new Response(200, 'text/html', EditAccountController::getEditAccount())
]);

// LogOut page route

$router->get('/wapp/logout', [
    'middlewares' => [
        'RequireSessionLogin'
    ],
    fn($request) => new Response(200, 'text/html', LogOutController::getLogOut($request))
]);



