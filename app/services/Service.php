<?php

namespace app\services;

use app\db\DatabaseConnection;


/**
 * Generic service
 * 
 * Includes all generic functions that a service can use
 * 
 * @package app\services
 */
class Service
{

    /**
     * 
     * Returns the type of the parameter
     * 
     * @return string parameter type (i, s, d)
     */
    private static function getParameterType($parameter)
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
    public static function getAllElements($tableName)
    {

        try {

            $db = new DatabaseConnection();
            $conn = $db->getConnection();

            $sql = 'SELECT * FROM ' . $tableName;
            $result = $conn->query($sql);

            if ($result) {
                $elements = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $elements = array();
            }

            $result->free();
            $conn->close();
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
    public static function getElementByParameter($tableName, $parameterToCompare, $parameterToSearch)
    {

        try {

            $db = new DatabaseConnection();
            $conn = $db->getConnection();

            $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $parameterToCompare . ' = ?';
            $stmt = $conn->prepare($sql);
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
            $conn->close();
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
     * @param array $parameters data to insert ( ['columnName' => value] )
     * 
     * @return boolean
     */
    protected static function insertElement($tableName, $parameters)
    {

        $parametersKeys = array_keys($parameters);

        $parametersValues = array_values($parameters);

        try {

            $db = new DatabaseConnection();
            $conn = $db->getConnection();
            $conn->begin_transaction();

            $sql = 'INSERT INTO ' . $tableName . ' (' . implode(', ', $parametersKeys) . ') VALUES (' . implode(', ', array_fill(0, count($parametersKeys), '?')) . ')';

            $stmt = $conn->prepare($sql);

            $parametersTypes = array_map(function ($parameterType) {
                return self::getParameterType($parameterType);
            }, $parametersValues);

            $stmt->bind_param(implode('', $parametersTypes), ...$parametersValues);

            $stmt->execute();
            $conn->commit();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();
            $conn->close();

            return true;
        } catch (\mysqli_sql_exception $e) {
            $conn->rollback();
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
    public static function deleteElementByParameter($tableName, $parameterToCompare, $parameterToSearch)
    {

        try {

            $db = new DatabaseConnection;
            $conn = $db->getConnection();
            $conn->begin_transaction();

            $sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $parameterToCompare . ' = ?';

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(self::getParameterType($parameterToSearch), $parameterToSearch);

            $stmt->execute();
            $conn->commit();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();
            $conn->close();

            return true;
        } catch (\mysqli_sql_exception $e) {
            $conn->rollback();
            throw $e;
        }
    }
    /**
     * Update element by parameter
     * 
     * @param string $tableName table name
     * 
     * @param array $parameters data to insert ( ['columnName' => value] )
     * 
     * @param string $parameterToCompare parameter to compare
     * 
     * @param string $parameterToSearch parameter to search
     * 
     * @return boolean
     */

    public static function updateElementByParameter($tableName, $parameters, $parameterToCompare, $parameterToSearch)
    {

        $keys = array_keys($parameters);
        $values = array_values($parameters);

        $parameterTypes = array_map(function ($parameterType) {
            return self::getParameterType($parameterType);
        }, $values);

        array_push($parameterTypes, self::getParameterType($parameterToSearch));
        array_push($values, $parameterToSearch);

        $columnNames = implode(' = ?, ', $keys);
        try {
            $db = new DatabaseConnection;
            $conn = $db->getConnection();
            $conn->begin_transaction();

            $sql = 'UPDATE ' . $tableName . ' SET '  .  $columnNames . '=? WHERE ' . $parameterToCompare . ' = ?';
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(implode("", $parameterTypes), ...$values);
            $stmt->execute();

            $conn->commit();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();
            $conn->close();
            return true;

        } catch (\mysqli_sql_exception $e) {
            $conn->rollback();
            throw $e;
        }
    }
}
