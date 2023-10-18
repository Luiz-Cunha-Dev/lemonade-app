<?php

namespace app\db;

class DatabaseConnection {

    private $connection;

    public function __construct() {
        $this->connection = new \mysqli($_ENV['HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE']);
        $this->connection->autocommit(FALSE);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($query, $result_mode=MYSQLI_STORE_RESULT) {
        return $this->connection->query($query, $result_mode);
    }

    public function close() {
        $this->connection->close();
    }
}