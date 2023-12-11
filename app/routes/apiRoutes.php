<?php

use app\routes\http\Response;
use app\controllers\api\CityController;
use app\controllers\api\StateController;
use app\controllers\api\UserController;
use app\controllers\api\UserPracticeExamController;
use app\controllers\api\RandomQuestionController;

// Cities api route

$router->get('/api/cities', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn () => new Response(200, 'application/json', CityController::getCities())
]);

// States api route

$router->get('/api/states', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn () => new Response(200, 'application/json', StateController::getStates())
]);

// User api routes

$router->get('/api/users', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn ($request) => new Response(200, 'application/json', UserController::getAllUsers($request))
]);

$router->post('/api/users', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn ($request) => new Response(200, 'application/json', UserController::createUser($request))
]);

$router->get('/api/user', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn ($request) => new Response(200, 'application/json', UserController::getUserByParameter($request))
]);

$router->put('/api/user/update/{id}', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn ($request, $id) => new Response(200, 'application/json', UserController::updateUserById($request, $id))
]);

$router->post('/api/user/uploadProfilePicture/{id}', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn ($request, $id) => new Response(200, 'application/json', UserController::updateUserProfilePictureById($request, $id))
]);

$router->delete('/api/user/delete/{id}', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn ($id) => new Response(200, 'application/json', UserController::deleteUserById($id))
]);

// User Practice exam routes

$router->post('/api/userPracticeExam/finish', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn($request) => new Response(200, 'application/json', UserPracticeExamController::finishUserPracticeExam($request))
]);

$router->get('/api/userPracticeExam/questions',[
    /*'middlewares' => [
       'InternalApiToken'
    ],*/
    fn($request) => new Response(200, 'application/json', UserPracticeExamController::getUserPracticeExamQuestions($request))
]);

$router->get('/api/randomQuestion',[
    /*'middlewares' => [
       'InternalApiToken'
    ],*/
    fn() => new Response(200, 'application/json', RandomQuestionController::getRandomQuestion())
]);