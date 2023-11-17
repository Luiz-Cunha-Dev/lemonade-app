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
        } catch (\Exception $e) {
            throw new Exception();
        }
    }
}
