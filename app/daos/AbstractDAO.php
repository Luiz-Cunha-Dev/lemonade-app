<?php

namespace app\daos;

use Exception;
use mysqli;

/**
 * Abstract DAO
 * 
 * Includes all generic methods that a DAO can use
 * 
 * @package app\daos
 */
abstract class AbstractDAO
{

    /**
     * 
     * Database connection
     * 
     * @var mysqli $conn connection
     */
    protected $conn;

    /**
     * Class constructor
     * 
     * Instantiates a connection
     */
    final public function __construct($connection)
    {
        $this->conn = $connection;
    }

    /**
     * Remove array null values
     * @param array $array array to remove null values from
     * @return array array without null values
     */
    final protected function removeArrayNullValues($array)
    {
        return array_filter($array, function ($value) {
            return isset($value);
        });
    }

    /**
     * Close connection
     */
    final public function closeConnection()
    {
        $this->conn->close();
    }

    /**
     * Begin an transaction
     */
    final public function beginTransaction()
    {
        $this->conn->begin_transaction();
    }

    /**
     * Commit an transaction
     */
    final public function commitTransaction()
    {
        $this->conn->commit();
    }

    /**
     * Rollback an transaction
     */
    final public function rollbackTransaction()
    {
        $this->conn->rollback();
    }

    /**
     * 
     * Returns the type of the parameter
     * 
     * @return string parameter type (i, s, d)
     */
    final protected function getParameterType($parameter)
    {

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
    final protected function getAllElements($tableName)
    {

        try {

            $sql = 'SELECT * FROM ' . $tableName;
            $result = $this->conn->query($sql);

            if ($result) {
                $elements = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $elements = array();
            }

            $result->free();

            return $elements;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get all elements with pagination
     * 
     * If it is null, returns an empty array
     * 
     * @param string $tableName table name
     * @param integer $offset offset
     * @param integer $limit limit
     * @return array elements
     */
    final protected function getAllElementsWithPagination($tableName, $offset, $limit)
    {

        try {

            $sql = 'WITH tableaux AS (SELECT *, ROW_NUMBER() OVER () AS rowNumber FROM ' . $tableName . ') SELECT * FROM tableaux WHERE rowNumber >= ' . $offset .
                ' AND rowNumber <= ' . $offset . ' + ' . $limit;

            $result = $this->conn->query($sql);

            if ($result) {
                $elements = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $elements = array();
            }

            $result->free();

            return $elements;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Get element by parameter
     * 
     * If it is null, returns an empty array
     * 
     * @param string $tableName table name
     * 
     * @param string $parameterToCompare parameter to compare
     * 
     * @param string $parameterToSearch parameter to search
     * 
     * @return array element
     */
    final protected function getElementByParameter($tableName, $parameterToCompare, $parameterToSearch)
    {

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

            return $element;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get elements by parameter
     * 
     * If it is null, returns an empty array
     * 
     * @param string $tableName table name
     * 
     * @param string $parameterToCompare parameter to compare
     * 
     * @param string $parameterToSearch parameter to search
     * 
     * @return array elements
     */
    final protected function getElementsByParameter($tableName, $parameterToCompare, $parameterToSearch)
    {

        try {

            $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $parameterToCompare . ' = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(self::getParameterType($parameterToSearch), $parameterToSearch);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result) {
                $elements = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $elements = array();
            }

            $result->free();

            return $elements;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get element by parameters
     * 
     * If it is null, returns an empty array
     * 
     * @param string $tableName table name
     * 
     * @param array $parametersToCompareAndSearch parameters to compare and search
     * 
     * @return array element
     */
    final protected function getElementByParameters($tableName, $parametersToCompareAndSearch)
    {

        try {

            $parametersKeys = array_keys($parametersToCompareAndSearch);

            $parametersValues = array_values($parametersToCompareAndSearch);

            $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . implode(' = ? AND ', ($parametersKeys)) . ' = ?';

            $stmt = $this->conn->prepare($sql);

            $parametersTypes = array_map(function ($parameterType) {
                return self::getParameterType($parameterType);
            }, $parametersKeys);

            $stmt->bind_param(implode('', $parametersTypes), ...$parametersValues);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result) {
                $element = $result->fetch_assoc();
            } else {
                $element = array();
            }

            $result->free();

            return $element;
        } catch (Exception $e) {
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
    final protected function insertElement($tableName, $dataToInsert)
    {

        $dataToInsert = $this->removeArrayNullValues($dataToInsert);

        $parametersKeys = array_keys($dataToInsert);

        $parametersValues = array_values($dataToInsert);

        try {

            $sql = 'INSERT INTO ' . $tableName . ' (' . implode(', ', $parametersKeys) . ') VALUES (' . implode(', ', array_fill(0, count($parametersKeys), '?')) . ')';

            $stmt = $this->conn->prepare($sql);

            $parametersTypes = array_map(function ($parameterType) {
                return self::getParameterType($parameterType);
            }, $parametersValues);

            $stmt->bind_param(implode('', $parametersTypes), ...$parametersValues);

            $stmt->execute();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();

            return true;
        } catch (Exception $e) {
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

    final protected function updateElementByParameter($tableName, $parameterToCompare, $parameterToSearch, $dataToUpdate)
    {

        $dataToUpdate = $this->removeArrayNullValues($dataToUpdate);

        $keys = array_keys($dataToUpdate);
        $values = array_values($dataToUpdate);

        $parameterTypes = array_map(function ($parameterType) {
            return self::getParameterType($parameterType);
        }, $values);

        array_push($parameterTypes, self::getParameterType($parameterToSearch));
        array_push($values, $parameterToSearch);

        $columnNames = implode(' = ?, ', $keys);

        try {

            $sql = 'UPDATE ' . $tableName . ' SET '  .  $columnNames . '=? WHERE ' . $parameterToCompare . ' = ?';

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(implode("", $parameterTypes), ...$values);
            $stmt->execute();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();

            return true;
        } catch (Exception $e) {
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
    final protected function deleteElementByParameter($tableName, $parameterToCompare, $parameterToSearch)
    {

        try {

            $sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $parameterToCompare . ' = ?';

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param(self::getParameterType($parameterToSearch), $parameterToSearch);

            $stmt->execute();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
