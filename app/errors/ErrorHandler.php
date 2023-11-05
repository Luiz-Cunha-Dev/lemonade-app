<?php

namespace app\errors;

use app\routes\http\Response;
use app\views\View;

/**
 * Error handler
 * 
 * Standard for handling errors, returns an html page
 * HTML file: ./views/pages/errorPage.html
 * 
 * @package app\errors
 */
class ErrorHandler {

    public function __construct() {

        @set_error_handler(array($this, 'handle'));

    }

    public static function handle($errorLevel, $errorMessage, $errorFilePath, $errorLine) {
        $file = explode('/', $errorFilePath);
        $file = end($file);
        (new Response(500, 'text/html', View::render('pages/errorPage', [
            'errorCode' => 500,
            'errorMessage' => 'Erro interno do servidor',
            'errorDescription' => $errorMessage . ' in ' . $file . ' on line ' . $errorLine
        ])))->sendResponse();
    }

}