<?php

/**
 * Short project description
 *
 * Long project description
 *
 * PHP version 8.1.2
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @author     Bruno da Costa Calegari
 * @author     Luiz Miguel da Cunha
 * @author     Felipe Santana de Rose
 * @author     Phelipe Gonçalves Borges
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link       https://github.com/Luiz-Cunha-Dev/lemonade-app
*/

require __DIR__.'/app/app.php';

use app\routes\Router;

// Start router

$router = new Router(URL);

// Include page routes

include __DIR__.'/app/routes/index.php';

// Print page response

$router->serve()
       ->sendResponse();
