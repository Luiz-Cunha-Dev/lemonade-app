<?php

require __DIR__.'/../vendor/autoload.php';

use app\routes\middleware\MiddlewareQueue;
use app\views\View;
use app\errors\ErrorHandler;
use app\errors\ExceptionHandler;

// Error and Exception handling

new ExceptionHandler();
new ErrorHandler();

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
       'RequireSessionLogout' => app\middlewares\SessionLogoutMiddleware::class,
       'RequireSessionLogin' => app\middlewares\SessionLoginMiddleware::class,
       'IsSessionExpired' => app\middlewares\SessionExpiredMiddleware::class
]);
