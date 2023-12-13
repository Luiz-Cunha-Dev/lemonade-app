<?php 

namespace app\daos;

use app\models\UserPracticeExamQuestionDiscursiveModel;
use Exception;

class UserPracticeExamQuestionDiscursiveDAO extends AbstractDAO{

    /**
     * Insert user practice Exam discursive question in db
     * 
     * @param array $UserPracticeExamQuestionDiscursiveData
     * 
     * if its null, returns empty array
     * 
     * @return boolean
     */
    public function insertUserPracticeExamQuestionDiscursive($userPracticeExamQuestionDiscursiveData){

        try {
    
            $insert = parent::insertElement('userPracticeExamQuestionDiscursive', $userPracticeExamQuestionDiscursiveData);
    
            if(!$insert){
                return false;
            } 
    
            return $insert;
    
        } catch (Exception $e) {
            throw $e;
        }

    }
}
