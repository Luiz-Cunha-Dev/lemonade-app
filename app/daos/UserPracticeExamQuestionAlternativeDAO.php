<?php 

namespace app\daos;

use app\models\UserPracticeExamQuestionAlternativeModel;
use Exception;

class UserPracticeExamQuestionAlternativeDAO extends AbstractDAO{

    /**
     * Get user practice exam question alternatives by id user practice exam and id question alternative  
     * 
     * @param integer id user practice exam
     * 
     * If it is null, returns an empty array
     * 
     * @return array UserPracticeExamQuestionAlternative user practice exam
     */
    public function getUserPracticeExamQuestionAlternatives ($idUserPracticeExam){

        try {
            $userQuestionAlternatives = parent::getElementsByParameter('userPracticeExamQuestionAlternative', 'idUserPracticeExam', $idUserPracticeExam);

            if (empty($userQuestionAlternatives)){
                return array();
            }

            $userQuestionAlternatives = array_map(function($qa){
                return new UserPracticeExamQuestionAlternativeModel($qa['idUserPracticeExam'], $qa['idQuestionAlternative']);
            }, $userQuestionAlternatives);
            

            return $userQuestionAlternatives;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Insert user practice exam question alternatives  
     * 
     * @param array user practice exam question alternative data
     * 
     * @return boolean
     */
    public function insertUserPracticeExamQuestionAlternative($userQuestionAlternativeData){

        try {
            return parent::insertElement('userPracticeExamQuestionAlternative', $userQuestionAlternativeData->toArray());
        } catch (Exception $e) {
            throw $e;
        }

    }
}