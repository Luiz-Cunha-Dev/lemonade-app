<?php 

namespace app\models;

use app\db\DatabaseConnection;

class UserModel {

    public static function getAllUsers() {

        try {
            $db = new DatabaseConnection();

            $result = $db->query('SELECT * FROM user');

            $users = $result->fetch_all();

            $result->free();

            $db->close();

            return $users;

        } catch( \Exception $e ) {
            throw $e;
        }
 
    }

}