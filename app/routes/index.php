<?php

use app\routes\http\Response;
use app\controllers;



// Home page route
$router->get('/', [
    fn() => new Response(200, 'text/html', controllers\website\HomeController::getHome())
]);

// PhpLove route
$router->get('/php', [
    fn() => new Response(200, 'text/html', controllers\website\PhpLoveController::getPhpLove())
]);

//PhpTeste route

$router->get('/testeUser', [
    fn() => new Response(200, 'text/html', controllers\website\TesteController::getTeste())
]);
