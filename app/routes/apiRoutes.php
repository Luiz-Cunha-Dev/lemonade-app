<?php

use app\routes\http\Response;
use app\controllers\api\CityController;
use app\controllers\api\StateController;
use app\controllers\api\UserController;
use app\controllers\api\UserPracticeExamController;
use app\controllers\api\PracticeExamController;
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

$router->get('/api/userPracticeExam/ranking', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn($request) => new Response(200, 'application/json', UserPracticeExamController::getUsersRanking($request))
]);

$router->get('/api/userPracticeExam/{idUser}', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn($idUser) => new Response(200, 'application/json', UserPracticeExamController::getAllUserPracticeExamsByIdUser($idUser))
]);

$router->post('/api/userPracticeExam', [
    'middlewares' => [
        'InternalApiToken'
    ],
    fn($request) => new Response(200, 'application/json', UserPracticeExamController::finishUserPracticeExam($request))
]);

// Practice exam routes
$router->get('/api/practiceExam/{idPracticeExam}',[
    'middlewares' => [
       'InternalApiToken'
    ],
    fn($idPracticeExam) => new Response(200, 'application/json', PracticeExamController::getPracticeExamQuestions($idPracticeExam))
]);

$router->get('/api/practiceExam',[
    'middlewares' => [
       'InternalApiToken'
    ],
    fn() => new Response(200, 'application/json', PracticeExamController::getAllPracticeExams())
]);

$router->post('/api/practiceExam',[
    'middlewares' => [
       'InternalApiToken'
    ],
    fn($request) => new Response(200, 'application/json', PracticeExamController::insertUserCreatedPracticeExam($request))
]);

// Random question route
$router->get('/api/randomQuestion',[
    'middlewares' => [
       'InternalApiToken'
    ],
    fn() => new Response(200, 'application/json', RandomQuestionController::getRandomQuestion())
]);