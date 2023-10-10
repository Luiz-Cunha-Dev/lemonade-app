<?php

use app\routes\http\Response;
use app\controllers;

// Home page route
$router->get('/', [
    fn() => new Response(200, 'text/html', controllers\HomeController::getHome())
]);

// PhpLove route
$router->get('/php', [
    fn() => new Response(200, 'text/html', controllers\PhpLoveController::getPhpLove())
]);
