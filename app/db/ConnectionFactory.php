<?php

namespace app\db;

use mysqli;

/**
 * Database connection factory
 * 
 * Handles database connections
 * 
 * @package app\db
 */ 
class ConnectionFactory {

    /**
     * Returns a database connection
     * 
     * @return mysqli connection
     */
    public function getConnection() {
        return self::createDataSource();
    }

    /**
     * Create a database connection
     * 
     * @return mysqli
     */
    private function createDataSource() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $dataSource = new mysqli($_ENV['HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE']);
        $dataSource->set_charset('utf8');
        $dataSource->autocommit(FALSE);
        return $dataSource;
    }

}