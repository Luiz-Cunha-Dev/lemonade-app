<?php

require __DIR__.'/../vendor/autoload.php';

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
