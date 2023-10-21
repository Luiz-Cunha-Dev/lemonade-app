<?php 

namespace app\models;

use app\db\DatabaseConnection;

/**
 * Generic model
 * 
 * Includes all generic functions that a model can use
 * 
 * @package app\models
 */ 
class Model {

    /**
     * 
     * Returns the type of the parameter
     * 
     * @return string parameter type (i, s, d)
     */
    private static function getParameterType($parameter) {

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
     * @param string $tableName table name
     * 
     * @return array elements
     */
    public static function getAllElements($tableName) {

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

        } catch( \Exception $e ) {
            throw $e;
        }
    }

    /**
     * Get element by parameter
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
    public static function getElementByParameter($tableName, $parameterToCompare, $parameterToSearch) {

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

        } catch( \Exception $e ) {
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
     * @return array element
     */
    public static function insertElement($tableName, $parameters) {

        $parametersKeys = array_keys($parameters);

        $parametersValues = array_values($parameters);

        try {

            $db = new DatabaseConnection();
            $conn = $db->getConnection();
            $conn->begin_transaction();

            $sql = 'INSERT INTO ' . $tableName . ' (' . implode(', ', $parametersKeys) . ') VALUES (' . implode(', ', array_fill(0, count($parametersKeys), '?')) . ')';
            $stmt = $conn->prepare($sql);

            foreach($parametersValues as $parameter) {
                $stmt->bind_param(self::getParameterType($parameter), $parameter);
            }
            
            $stmt->execute();
            $conn->commit();

            if ($stmt->affected_rows == 0) {
                return false;
            }

            $stmt->close();
            $conn->close();

            return true;

        } catch( \mysqli_sql_exception $e ) {
            $conn->rollback();
            throw $e;
        }

    }

}
