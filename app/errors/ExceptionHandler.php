<?php

namespace app\errors;

use app\routes\http\Response;
use app\views\View;
use Exception;

/**
 * Exception handler
 * 
 * Standard for handling exceptions, returns an html page
 * HTML file: ./views/pages/errorPage.html
 * 
 * @package app\errors
 */
class ExceptionHandler {

    public function __construct() {

        @set_exception_handler(array($this, 'handle'));

    }

    public static function handle(Exception $e) {
        (new Response($e->getCode(), 'text/html', View::render('pages/errorPage', [
            'errorCode' => $e->getCode(),
            'errorMessage' => 'Erro interno do servidor',
            'errorDescription' => $e->getMessage()
        ])))->sendResponse();
    }

}