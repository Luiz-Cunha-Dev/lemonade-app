<?php

use app\controllers\webapp\QuestionController;
use app\controllers\webapp\AppController;
use app\controllers\webapp\FirstAccessController;
use app\controllers\webapp\LogOutController;
use app\controllers\webapp\RankingController;
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

// LogOut page route

$router->get('/wapp/logout', [
    'middlewares' => [
        'RequireSessionLogin'
    ],
    fn($request) => new Response(200, 'text/html', LogOutController::getLogOut($request))
]);

$router->get('/question/alternatives',[
    fn() => new Response(200, 'application/json', QuestionController::getQuestionAlternativesByIdQuestion(1))
]);

$router->get('/questions',[
    fn() => new Response(200, 'application/json', QuestionController::getQuestionById(1))
]);

$router->get('/questions/texts',[
    fn() => new Response(200, 'application/json', QuestionController::getQuestionTextsByIdQuestion(1))
]);


