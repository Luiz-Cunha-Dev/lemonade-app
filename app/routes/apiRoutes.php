<?php

use app\routes\http\Response;
use app\controllers\api\CityController;
use app\controllers\api\StateController;

// Cities api route

$router->get('/api/cities', [
    'middlewares' => [
        'inApiToken'
    ],
    fn() => new Response(200, 'application/json', CityController::getCities())
]);

// States api route

$router->get('/api/states', [
    'middlewares' => [
        'inApiToken'
    ],
    fn() => new Response(200, 'application/json', StateController::getStates())
]);
