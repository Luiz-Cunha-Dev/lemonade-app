<?php

namespace app\daos;

use app\models\UserPracticeExamModel;
use Exception;

/**
 *User practice Exam DAO
 * 
 * Responsible for reading and writing data of UserPracticeExam entity
 * 
 * @package app\daos
 */
class UserPracticeExamDAO extends AbstractDAO
{

    /**
     * Get user practice exam by id user and id practice exam
     * 
     * @param integer id user 
     * 
     * @param integer id practice exam
     * 
     * If it is null, returns an empty array
     * 
     * @return UserPracticeExamModel user practice exam
     */
    public function getIdUserPracticeExamByIdUserAndIdPracticeExam($idUser, $idPracticeExam)
    {

        try {

            $sql = 'SELECT idUserPracticeExam FROM userPracticeExam WHERE idUser = ? AND idPracticeExam = ? ORDER BY idUserPracticeExam DESC
            LIMIT 1';

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param('ii', $idUser, $idPracticeExam);

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
     * Get user practice exams by id user
     * 
     * @param integer id user 
     * 
     * If it is null, returns an empty array
     * 
     * @return array userPracticeExams
     */
    public function getAllUserPracticeExamsByIdUser($idUser)
    {

        try {

            $userPracticeExams = parent::getElementsByParameter('userPracticeExam', 'idUser', $idUser);


            if (empty($userPracticeExams)) {
                return array();
            }

            return $userPracticeExams;
        } catch (Exception $e) {
            throw new Exception();
        }
    }
    
    public function getAllHigherGradeUserPracticeExamsByIdUser($idUser)
    {

        try {

            $sql = 'SELECT  userPracticeExam.*
            FROM userPracticeExam
            JOIN (
                SELECT idUser, idPracticeExam, MAX(grade) AS maxGrade
                FROM userPracticeExam
                WHERE idUser = ?
                GROUP BY idUser, idPracticeExam
            ) maxGrades ON userPracticeExam.idUser = maxGrades.idUser
                       AND userPracticeExam.idPracticeExam = maxGrades.idPracticeExam
                       AND userPracticeExam.grade = maxGrades.maxGrade
            WHERE userPracticeExam.idUser = ?
            ORDER BY userPracticeExam.idUser, userPracticeExam.idPracticeExam, userPracticeExam.grade DESC, userPracticeExam.startDate DESC;';
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ii', $idUser, $idUser);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result) {
                $userPracticeExams = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $userPracticeExams = array();
            }

            $result->free();


            return $userPracticeExams;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get user practice exam by id
     * 
     * @param integer id user practice exam
     * 
     * If it is null, returns an empty array
     * 
     * @return UserPracticeExamModel user practice exam
     */
    public function getUserPracticeExamById($idUserPracticeExam)
    {

        try {

            $userPracticeExam = parent::getElementByParameter('userPracticeExam', 'idUserPracticeExam', $idUserPracticeExam);

            if (empty($userPracticeExam)) {
                return array();
            }


            $userPracticeExam = new UserPracticeExamModel($userPracticeExam['idUserPracticeExam'], $userPracticeExam['startDate'], $userPracticeExam['endDate'], $userPracticeExam['grade'], $userPracticeExam['idUser'], $userPracticeExam['idPracticeExam']);

            return $userPracticeExam;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    /**
     * Insert user practice exam by id
     * 
     * @param UserPracticeExamModel user practice exam to insert
     * 
     * @return boolean
     */
    public function insertUserPracticeExam($userPracticeExam)
    {

        try {
            return parent::insertElement('userPracticeExam', $userPracticeExam->toArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update user practice exam by id
     * 
     * @param UserPracticeExamModel user practice exam to update
     * 
     * @param integer id user practice exam to update
     * 
     * @return boolean
     */
    public function updateUserPracticeExamById($userPracticeExamData, $idUserPracticeExam)
    {

        try {
            return parent::updateElementByParameter('userPracticeExam', 'idUserPracticeExam', $idUserPracticeExam, $userPracticeExamData->toArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Delete user practice exam by id
     * 
     * @param integer id user practice exam
     *
     * @return boolean
     */
    public function deleteUserPracticeExamById($idUserPracticeExam)
    {

        try {
            return parent::deleteElementByParameter('userPracticeExam', 'idUserPracticeExam', $idUserPracticeExam);
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    /**
     * Get user ranking
     * 
     * @param integer offset
     * 
     * @param integer limit
     *
     * @return array usersRanking
     */
    public function getUserRankingWithPagination($offset, $limit)
    {

        try {

            $sql = 'WITH tableaux AS (
                SELECT idUser, idPracticeExam, MAX(grade) AS grade, ROW_NUMBER() OVER () AS rowNumber 
                FROM userPracticeExam 
                GROUP BY idUser, idPracticeExam
                ORDER BY idUser, idPracticeExam) 
                SELECT user."profilePicture", CONCAT(user.name, " ", user.lastName) AS "fullName", city.uf, SUM(tableaux.grade) AS "score"
                FROM tableaux 
                INNER JOIN user ON tableaux.idUser = user.idUser
                INNER JOIN city ON user.idCity = city.idCity
                WHERE rowNumber > ' . $offset .
                ' AND rowNumber <= ' . $offset . ' + ' . $limit .
                ' GROUP BY tableaux.idUser, "fullName", uf
                ORDER BY score DESC;';

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
}
