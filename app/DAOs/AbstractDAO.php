<?php

namespace app\DAOs;

use app\db\ConnectionFactory;

/**
 * Abstract DAO
 * 
 * Includes all generic methods that a DAO can use
 * 
 * @package app\DAOs
 */
abstract class AbstractDAO {

    /**
     * 
     * Database connection
     * 
     * @var ConnectionFactory $conn database connection
     */
    protected $conn;



    final public function __construct ($connection) {
        $this->conn = $connection;
    }

    

    /**
     * 
     * Returns the type of the parameter
     * 
     * @return string parameter type (i, s, d)
     */
    final protected function getParameterType($parameter) {

        switch (gettype($parameter)) {
            case 'integer':
                $parameterType = 'i';
                break;
            case 'string':
                $parameterType = 's';
                break;
            case 'double':
                $parameterType = 'd';
                break;
        }

        return $parameterType;
    }

    /**
     * Get all elements
     * 
     * If it is null, returns an empty array
     * 
     * @param string $tableName table name
     * 
     * @return array elements
     */
    final protected function getAllElements($tableName) {

        try {

            $sql = 'SELECT * FROM ' . $tableName;
            $result = $this->conn->query($sql);

            if ($result) {
                $elements = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $elements = array();
            }

            $result->free();
            $this->conn->close();
            return $elements;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Get element by parameter
     * 
     * 
     * If it is null, returns an empty array
     * 
     * @param string $tableName table name
     * 
     * @param string $parameterToCompare parameter to compare
     * 
     * @param string $parameterToSearch parameter to search
     * 
     * @param string $parameterType parameter type (i, s, d)
     * 
     * @return array element
     */
    final protected function getElementByParameter($tableName, $parameterToCompare, $parameterToSearch) {

        try {

            $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $parameterToCompare . ' = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(self::getParameterType($parameterToSearch), $parameterToSearch);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result) {
                $element = $result->fetch_assoc();
            } else {
                $element = array();
            }

            $result->free();
            $this->conn->close();
            return $element;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Insert an element
     * 
     * @param string $tableName table name
     * 
     * @param array $dataToInsert data to insert ( ['columnName' => value] )
     * 
     * @return boolean
     */
    final protected function insertElement($tableName, $dataToInsert) {

        $parametersKeys = array_keys($dataToInsert);

        $parametersValues = array_values($dataToInsert);

        try {

            $this->conn->begin_transaction();

            $sql = 'INSERT INTO ' . $tableName . ' (' . implode(', ', $parametersKeys) . ') VALUES (' . implode(', ', array_fill(0, count($parametersKeys), '?')) . ')';

            $stmt = $this->conn->prepare($sql);

            $parametersTypes = array_map(function ($parameterType) {
                return self::getParameterType($parameterType);
            }, $parametersValues);

            $stmt->bind_param(implode('', $parametersTypes), ...$parametersValues);

            $stmt->execute();
            $this->conn->commit();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();
            $this->conn->close();

            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    /**
     * Update element by parameter
     * 
     * @param string $tableName table name
     * 
     * @param string $parameterToCompare parameter to compare
     * 
     * @param string $parameterToSearch parameter to search
     * 
     * @param array $dataToUpdate data to update ( ['columnName' => value] )
     * 
     * @return boolean
     */

     final protected function updateElementByParameter($tableName, $parameterToCompare, $parameterToSearch, $dataToUpdate) {

        $keys = array_keys($dataToUpdate);
        $values = array_values($dataToUpdate);

        $parameterTypes = array_map(function ($parameterType) {
            return self::getParameterType($parameterType);
        }, $values);

        array_push($parameterTypes, self::getParameterType($parameterToSearch));
        array_push($values, $parameterToSearch);

        $columnNames = implode(' = ?, ', $keys);

        try {

            $this->conn->begin_transaction();

            $sql = 'UPDATE ' . $tableName . ' SET '  .  $columnNames . '=? WHERE ' . $parameterToCompare . ' = ?';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(implode("", $parameterTypes), ...$values);
            $stmt->execute();

            $this->conn->commit();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();
            $this->conn->close();
            return true;

        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    /**
     * Delete element by parameter
     * 
     * @param string $tableName table name
     * 
     * @param string $parameterToCompare parameter to compare
     * 
     * @param string $parameterToSearch parameter to search
     * 
     * @return boolean
     */
    final protected function deleteElementByParameter($tableName, $parameterToCompare, $parameterToSearch) {

        try {

            $this->conn->begin_transaction();

            $sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $parameterToCompare . ' = ?';

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param(self::getParameterType($parameterToSearch), $parameterToSearch);

            $stmt->execute();
            $this->conn->commit();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();
            $this->conn->close();

            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }
}
