<?php

require __DIR__.'/../vendor/autoload.php';

use app\routes\middleware\MiddlewareQueue;
use app\views\View;

// Environment variables

$dotenv = Dotenv\Dotenv::createImmutable(DIRNAME(__DIR__, 1));
$dotenv->safeLoad();

// URL constant

define('URL', $_ENV['SERVER_URL']);

// Start view (default variables)

View::start([
       'URL' => URL
]);

// Middleware map

MiddlewareQueue::setMiddlewareMap([
       'inApiToken' => app\middlewares\InternalApiTokenMiddleware::class,
       'SessionLogout' => app\middlewares\SessionLogoutMiddleware::class
]);
