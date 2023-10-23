<?php

use app\routes\http\Response;
use app\controllers;

$cssFilePath = 'app/views/css/home.css';
$cssContent = file_get_contents($cssFilePath);

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
