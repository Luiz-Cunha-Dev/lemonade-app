<?php

namespace app\daos;

use app\models\PracticeExamModel;
use Exception;

/**
 * Practice Exam DAO
 * 
 * Responsible for reading and writing data of practiceExam entity
 * 
 * @package app\daos
 */
class PracticeExamDao extends AbstractDAO{

    /**
     * Get practice exam by id
     * 
     * @param integer id practice exam
     * 
     * If it is null, returns an empty array
     * 
     * @return practiceExam practice exam
     */
    public function getPracticeExamById($idPracticeExam){

        try {

            $practiceExam = parent::getElementByParameter('practiceExam', 'idPracticeExam', $idPracticeExam);

            if(empty($practiceExam)){

                return array();
            }

            $practiceExam = new PracticeExamModel($practiceExam['idPracticeExam'], $practiceExam['name'], $practiceExam['description']);
            
            
            return $practiceExam;

        } catch (\Throwable $e) {
            throw new Exception();
        }
        
    }

    /**
     * Get all practice exams 
     * 
     * If it is null, returns an empty array
     * 
     * @return array practiceExam practice exams
     */
    public function getAllPracticeExams(){

        try {

            $practiceExams = parent::getAllElements('practiceExam');
    
            if(empty($practiceExams)){
                return array();
            }
            
            return $practiceExams;

        } catch (\Throwable $e) {
            throw new Exception();
        }
    }
}