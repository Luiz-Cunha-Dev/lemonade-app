<?php 

namespace app\daos;

use app\models\UserModel;
use Exception;

/**
 * User DAO
 * 
 * Responsible for reading and writing data of user entity
 * 
 * @package app\daos
 */ 
class UserDao extends AbstractDAO {

    /**
     * Get all users
     * 
     * If it is null, returns an empty array
     * 
     * @return array users
     */
    public function getAllUsers() {

        try {
            $users = parent::getAllElements('user');

            if (empty($users)) {
                return array();
            }

            for ($i=0; $i < count($users); $i++) { 
                $users[$i] = new UserModel($users[$i]['idUser'], $users[$i]['name'], $users[$i]['lastName'], $users[$i]['email'], $users[$i]['nickname'], $users[$i]['password'],
                $users[$i]['phone'], $users[$i]['birthDate'], $users[$i]['profilePicture'], $users[$i]['street'], $users[$i]['streetNumber'], $users[$i]['district'], $users[$i]['complement'],
                $users[$i]['postalCode'], $users[$i]['firstAccess'], $users[$i]['idCity'], $users[$i]['idUserType']);
            }

            return $users;
        } catch(Exception $e ) {
            throw $e;
        }

    }

    /**
     * Count all users
     * 
     * If it is null, returns 0
     * 
     * @param string $countType type of users to count [all, common, admin]
     * @return array number of users
     */
    public function countAllUsers($countType) {

        try {
            
            if ($countType == 'all') {
                $users = parent::countAllElements('user');
            } elseif ($countType == 'common') {
                $users = parent::countAllElementsByParameter('user', 'idUserType', 1);
            } elseif ($countType == 'admin') {
                $users = parent::countAllElementsByParameter('user', 'idUserType', 2);
            } else {
                throw new Exception('Invalid count type');
            }
            
            return $users;
        } catch(Exception $e ) {
            throw $e;
        }

    }

    /**
     * Get all users with pagination
     * 
     * If it is null, returns an empty array
     * 
     * @param integer $offset offset
     * @param integer $limit limit
     * @param array $where where clause
     * @return array users
     */
    public function getAllUsersWithPagination($offset, $limit, $where=null) {

        try {
            $users = parent::getAllElementsWithPagination('user', $offset, $limit, $where);

            if (empty($users)) {
                return array();
            }

            for ($i=0; $i < count($users); $i++) { 
                $users[$i] = new UserModel($users[$i]['idUser'], $users[$i]['name'], $users[$i]['lastName'], $users[$i]['email'], $users[$i]['nickname'], $users[$i]['password'],
                $users[$i]['phone'], $users[$i]['birthDate'], $users[$i]['profilePicture'], $users[$i]['street'], $users[$i]['streetNumber'], $users[$i]['district'], $users[$i]['complement'],
                $users[$i]['postalCode'], $users[$i]['firstAccess'], $users[$i]['idCity'], $users[$i]['idUserType']);
            }

            return $users;
        } catch(Exception $e ) {
            throw $e;
        }

    }

    /**
     * Get all users by name and last name with pagination
     * 
     * If it is null, returns an empty array
     * 
     * @param integer $offset offset
     * @param integer $limit limit
     * @param string $userFullName name and last name of the user
     * @return array users
     */
    public function getAllUsersByNameAndLastNameWithPagination($offset, $limit, $userFullName) {

        try {

            $sql = 'WITH tableaux AS (SELECT *, ROW_NUMBER() OVER () AS rowNumber FROM user) SELECT * FROM tableaux WHERE rowNumber > ' . $offset .
            ' AND rowNumber <= ' . $offset . ' + ' . $limit;

            $sql .= " AND CONCAT(name, ' ', lastName) LIKE CONCAT('%', ? ,'%') ORDER BY CONCAT(name, ' ', lastName);";

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param('s', $userFullName);

            $stmt->execute();

            $result = $stmt->get_result();

            $stmt->close();

            if ($result) {
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $users = array();
            }

            $result->free();

            for ($i=0; $i < count($users); $i++) { 
                $users[$i] = new UserModel($users[$i]['idUser'], $users[$i]['name'], $users[$i]['lastName'], $users[$i]['email'], $users[$i]['nickname'], $users[$i]['password'],
                $users[$i]['phone'], $users[$i]['birthDate'], $users[$i]['profilePicture'], $users[$i]['street'], $users[$i]['streetNumber'], $users[$i]['district'], $users[$i]['complement'],
                $users[$i]['postalCode'], $users[$i]['firstAccess'], $users[$i]['idCity'], $users[$i]['idUserType']);
            }

            return $users;
        } catch(Exception $e ) {
            throw $e;
        }

    }

    /**
     * Get a user by id
     * 
     * If it is null, returns an empty array
     * 
     * @param int $idUser id of the user
     * 
     * @return UserModel user
     */
    public function getUserById($idUser){

        try {
            $user = parent::getElementByParameter('user', 'idUser', $idUser);

            if (empty($user)) {
                return array();
            }

            $user = new UserModel($user['idUser'], $user['name'], $user['lastName'], $user['email'], $user['nickname'], $user['password'], 
            $user['phone'], $user['birthDate'], $user['profilePicture'], $user['street'], $user['streetNumber'], $user['district'], $user['complement'],
            $user['postalCode'], $user['firstAccess'], $user['idCity'], $user['idUserType']);

            return $user;
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Get a user by email
     * 
     * If it is null, returns an empty array
     * 
     * @param string $emailUser email of the user
     * 
     * @return UserModel user
     */
    public function getUserByEmail($emailUser){

        try {
            $user = parent::getElementByParameter('user', 'email', $emailUser);

            if (empty($user)) {
                return array();
            }

            $user = new UserModel($user['idUser'], $user['name'], $user['lastName'], $user['email'], $user['nickname'], $user['password'], 
            $user['phone'], $user['birthDate'], $user['profilePicture'], $user['street'], $user['streetNumber'], $user['district'], $user['complement'],
            $user['postalCode'], $user['firstAccess'], $user['idCity'], $user['idUserType']);

            return $user;
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Get a user by nickname
     * 
     * If it is null, returns an empty array
     * 
     * @param string $nicknameUser nickname of the user
     * 
     * @return UserModel user
     */
    public function getUserByNickname($nicknameUser){

        try {
            $user = parent::getElementByParameter('user', 'nickname', $nicknameUser);

            if (empty($user)) {
                return array();
            }

            $user = new UserModel($user['idUser'], $user['name'], $user['lastName'], $user['email'], $user['nickname'], $user['password'], 
            $user['phone'], $user['birthDate'], $user['profilePicture'], $user['street'], $user['streetNumber'], $user['district'], $user['complement'],
            $user['postalCode'], $user['firstAccess'], $user['idCity'], $user['idUserType']);

            return $user;
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Get a user by parameters
     * 
     * If it is null, returns an empty array
     * 
     * @param array $parameters parameters
     * 
     * @return UserModel user
     */
    public function getUsersByParameters($parameters){

        try {
            $users = parent::getElementByParameters('user', $parameters);

            if (empty($users)) {
                return array();
            }
            
            $users = new UserModel($users['idUser'], $users['name'], $users['lastName'], $users['email'], $users['nickname'], $users['password'], 
            $users['phone'], $users['birthDate'], $users['profilePicture'], $users['street'], $users['streetNumber'], $users['district'], $users['complement'],
            $users['postalCode'], $users['firstAccess'], $users['idCity'], $users['idUserType']);

            return $users;
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Insert an user
     * 
     * @param UserModel user to insert
     * 
     * @return boolean
     */
    public function insertUser($user){

        try {
            return parent::insertElement('user', $user->toArray());
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Update an user
     * 
     * @param array $newUserData data to insert ( ['columnName' => value] )
     * 
     * @param integer $idUser id of the user
     * 
     * @return boolean
     */
    public function updateUserById($newUserData, $idUser){

        try {
            return parent::updateElementByParameter('user', 'idUser', $idUser, $newUserData);
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Delete an user
     * 
     * @param integer $idUser id of the user
     * 
     * @return boolean
     */
    public function deleteUserById($idUser){
        
        try {
            return parent::deleteElementByParameter('user', 'idUser', $idUser);
        } catch (Exception $e) {
            throw $e;
        }

    }

}
