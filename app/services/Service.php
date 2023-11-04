<?php

namespace app\services;

use app\db\ConnectionFactory;

/**
 * Abstract Service
 * 
 * Includes the generic constructor of an Service, and the protected attribute $conn
 * 
 * @package app\services
 */
abstract class Service {

    /**
     * ConnectionFactory
     * 
     * @var ConnectionFactory $conn Connection Factory
     */
    protected $conn;

    /**
     * Class constructor
     * 
     * Instantiates a ConnectionFactory
     */
    final public function __construct() {
        $this->conn = new ConnectionFactory();
    }

}
