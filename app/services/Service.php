<?php

namespace app\services;

use app\db\ConnectionFactory;

/**
 * Abstract Service
 * 
 * Includes the generic constructor of an Service, and the protected attribute $conn
 * 
 * @package app\DAOs
 */
abstract class Service {

    protected $conn;

    final public function __construct() {
        $this->conn = new ConnectionFactory();
    }

}
