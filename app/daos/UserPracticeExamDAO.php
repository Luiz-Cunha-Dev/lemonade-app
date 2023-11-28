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
     * Get user practice exam by id user
     * 
     * @param integer id user 
     * 
     * @param integer id practice exam
     * 
     * If it is null, returns an empty array
     * 
     * @return UserPracticeExamModel user practice exam
     */
    public function getUserPracticeExamsByIdUserAndIdUserPracticeExam($idUser, $idUserPracticeExam)
    {

        try {

            $usersPracticeExam = parent::getElementByParameters('userPracticeExam', [
                'idUser' => $idUser,
                'idPracticeExam' => $idUserPracticeExam
            ]);

            if (empty($usersPracticeExam)) {
                return array();
            }

            $usersPracticeExam = new UserPracticeExamModel(
                $usersPracticeExam['idUserPracticeExam'],
                $usersPracticeExam['startDate'],
                $usersPracticeExam['endDate'],
                $usersPracticeExam['grade'],
                $usersPracticeExam['idUser'],
                $usersPracticeExam['idPracticeExam']
            );

            return $usersPracticeExam;
        } catch (Exception $e) {
            throw new Exception();
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
}
