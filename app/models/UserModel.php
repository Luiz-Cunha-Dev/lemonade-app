<?php 

namespace app\models;

use app\db\DatabaseConnection;

class UserModel {

    public static function getAllUsers() {

    try {
        $db = new DatabaseConnection();

        $result = $db->query('SELECT * FROM user');

        if ($result) {
            $users = $result->fetch_all();
            $result->free();
        } else {
            $users = array(); // Atribuir um array vazio se não houver resultados
        }

        $db->close();

        return $users;

    } catch( \Exception $e ) {
        throw $e;
    }
}

public static function getUserById($id){
    try{
        $sql = "SELECT * FROM user WHERE iduser=?";
        $db = new DatabaseConnection();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;

    } catch (\Exception $e){
        throw $e;
    }
} 
}