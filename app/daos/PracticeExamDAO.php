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

        } catch (Exception $e) {
            throw $e;
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

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * insert practice exam 
     * 
     * @return boolean
     */
    public function insertPracticeExam($practiceExamData){

        try {
            $insertPracticeExam = parent::insertElement('practiceExam', $practiceExamData);
            return $insertPracticeExam;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get id practice exam of last inserted practice exam
     * 
     * @param return array $element
     */
    public function getMostRecentIdPracticeExam(){

        try {

            $sql = 'SELECT idPracticeExam FROM practiceExam ORDER BY idPracticeExam DESC LIMIT 1';

            $stmt = $this->conn->prepare($sql);

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
}