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
abstract class AbstractService {

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
    public function __construct() {
        $this->conn = new ConnectionFactory();
    }

}
