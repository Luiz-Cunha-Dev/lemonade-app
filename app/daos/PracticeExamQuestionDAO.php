<?php

namespace app\daos;

use app\models\PracticeExamQuestionModel;
use Exception;

/**
 * Practice Exam question DAO
 * 
 * Responsible for reading and writing data of practiceExamQuestion entity
 * 
 * @package app\daos
 */
class PracticeExamQuestionDao extends AbstractDAO
{

    /**
     * Get practice exam question by id question and id practice exam
     * 
     * @param integer id practice exam
     * 
     * @param integer id question
     * 
     * If it is null, returns an empty array
     * 
     * @return practiceExam practice exam
     */
    public function getPracticeExamQuestionByIds($idPracticeExam, $idQuestion)
    {

        try {

            $ids = [
                'idPracticeExam' => $idPracticeExam,
                'idQuestion' => $idQuestion
            ];

            $practiceExamQuestion = parent::getElementByParameters('practiceExamQuestion', $ids);

            if (empty($practiceExamQuestion)) {
                return array();
            }

            $practiceExamQuestion = new PracticeExamQuestionModel($practiceExamQuestion['idPracticeExam'], $practiceExamQuestion['idQuestion']);

            return $practiceExamQuestion;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get practice exam questions by id practice exam
     * 
     * @param integer id practice exam
     * 
     * If it is null, returns an empty array
     * 
     * @return array practiceExamQuestionModel practice exam questions
     */
    public function getPracticeExamQuestionsByIdPracticeExam($idPracticeExam){

        try {
            $practiceExamQuestions = parent::getElementsByParameter(
                'practiceExamQuestion', 
                'idPracticeExam', 
                $idPracticeExam
            );

            if(empty($practiceExamQuestions)){
                
                return array();
            }

            $practiceExamQuestions = array_map(function($peq){

                return new PracticeExamQuestionModel(
                    $peq['idPracticeExam'], 
                    $peq['idQuestion']
                );
            }, $practiceExamQuestions);

            return $practiceExamQuestions;

        } catch (Exception $e) {
            throw $e;
        }

    }

    public function insertPracticeExamQuestion($practiceExamQuestionData){

        try {
            return parent::insertElement('practiceExamQuestion', $practiceExamQuestionData);
        } catch (Exception $e) {
            throw $e;
        }
    }

    
}
