<?php

namespace app\db;

/**
 * Database Connection
 * 
 * Handles database connections
 * 
 * @package app\db
 */ 
class DatabaseConnection {

    /**
     * 
     * Database connection
     * 
     * @var mysqli connection
     */
    private $connection;
    
    /**
     * Class constructor
     * 
     * @return DatabaseConnection
     */
    public function __construct() {
        $this->connection = new \mysqli($_ENV['HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE']);
        $this->connection->autocommit(FALSE);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    /**
     * Returns a database connection
     * 
     * @return mysqli connection
     */
    public function getConnection() {
        return $this->connection;
    }

}