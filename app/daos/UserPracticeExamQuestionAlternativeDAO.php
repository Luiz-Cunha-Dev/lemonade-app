<?php 

namespace app\daos;

use app\models\UserPracticeExamQuestionAlternativeModel;
use Exception;

class UserPracticeExamQuestionAlternativeDAO extends AbstractDAO{

    /**
     * Get user question alternatives by id user practice exam and id question alternative  
     * 
     * @param integer id user practice exam
     * 
     * If it is null, returns an empty array
     * 
     * @return UserPracticeExamQuestionAlternative user practice exam
     */
    public function getUserPracticeExamQuestionAlternatives ($idUserPracticeExam){

        try {
            $userQuestionAlternatives = parent::getElementsByParameter('userPracticeExamQuestionAlternative', 'idUserPracticeExam', $idUserPracticeExam);

            if (empty($userQuestionAlternatives)){
                return array();
            }

            for ($i = 0; $i <= count($userQuestionAlternatives); $i++){

                $userQuestionAlternatives = new UserPracticeExamQuestionAlternativeModel(
                    $userQuestionAlternatives[$i]['idUserPracticeExam'],
                    $userQuestionAlternatives[$i]['idQuestionAlternative']);
            }

            return $userQuestionAlternatives;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insertUserPracticeExamQuestionAlternative($userQuestionAlternativeData){

        try {
            return parent::insertElement('userPracticeExamQuestionAlternative', $userQuestionAlternativeData);
        } catch (Exception $e) {
            throw $e;
        }

    }
}