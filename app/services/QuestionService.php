<?php

namespace app\services;

use app\daos\QuestionDAO;
use app\daos\QuestionAlternativeDAO;
use app\daos\QuestionDiscursiveDAO;
use app\daos\QuestionTextDAO;

use Exception;
use mysqli_sql_exception;

/**
 * Question Service
 * 
 * Responsible for orchestrating business rules related to questions in aplication 
 * 
 * @package app\services
 */
class QuestionService extends AbstractService
{

    /**
     * Question DAO
     * @var questionDAO $questionDAO
     */
    private $questionDAO;

    /**
     * Question alternative DAO
     * @var questionAlternativeDAO $questionAlternativeDAO
     */
    private $questionAlternativeDAO;

    /**
     * Question discursive DAO
     * @var questionDiscursiveDAO $questionDiscursiveDAO
     */
    private $questionDiscursiveDAO;

    /**
     * Question text DAO
     * @var questionTextDAO $questionTextDAO
     */
    private $questionTextDAO;

    /**
     * Class constructor
     * 
     * Return a new UserPracticeExam instance
     */
    public function __construct()
    {
        parent::__construct();
        $this->questionDAO = new QuestionDAO($this->conn->getConnection());
        $this->questionAlternativeDAO = new QuestionAlternativeDAO($this->conn->getConnection());
        $this->questionDiscursiveDAO = new QuestionDiscursiveDAO($this->conn->getConnection());
        $this->questionTextDAO = new QuestionTextDAO($this->conn->getConnection());
    }

    /**
     * Insert user created question
     * 
     * @param array $questionData 
     * 
     * @return boolean
     */
    public function insertUserCreatedQuestion($questionData)
    {

        $questionDataToInsert = [
            'idQuestion' => null,
            'statement' => $questionData['statement'],
            'idQuestionType' => $questionData['idQuestionType']
        ];

        try {

            $this->questionDAO->beginTransaction();

            $insertQuestion = $this->questionDAO->insertQuestion($questionDataToInsert);

            if(!$insertQuestion){
                return false;
            }

            $this->questionDAO->commitTransaction();

            $idQuestion = $this->questionDAO->getMostRecentIdQuestion();
            $idQuestion = $idQuestion['idQuestion'];

            $questionTextDataToInsert = [
                'idQuestionText' => null,
                'text' => $questionData['text'],
                'idQuestion' => $idQuestion
            ];

            $this->questionTextDAO->beginTransaction();

            $insertQuestionText = $this->questionTextDAO->insertQuestionText($questionTextDataToInsert);

            if(!$insertQuestionText){
                return false;
            }
            $this->questionTextDAO->commitTransaction();


            if ($questionData['idQuestionType'] == 1) {

                for ($i = 0; $i < count($questionData['alternatives']); $i++) {

                    $this->questionAlternativeDAO->beginTransaction();

                    $questionAlternativeDataToInsert = [
                        'idQuestionAlternative' => null,
                        'text' => $questionData['alternatives'][$i]['text'],
                        'isCorrect' => $questionData['alternatives'][$i]['isCorrect'],
                        'idQuestion' => $idQuestion
                    ];

                    $insertQuestionAlternative = $this->questionAlternativeDAO->insertQuestionAlternative($questionAlternativeDataToInsert);

                    if(!$insertQuestionAlternative){
                        return false;
                    }

                    $this->questionAlternativeDAO->commitTransaction();
                }
            } else {

                $questionDiscursiveDataToInsert = [
                    'idQuestionDiscursive' => null,
                    'baseResponse' => $questionData['baseResponse'],
                    'idQuestion' => $idQuestion
                ];

                $this->questionDiscursiveDAO->beginTransaction();

                print_r($questionDiscursiveDataToInsert);

                $insertQuestionDiscursive = $this->questionDiscursiveDAO->insertQuestionDiscursive($questionDiscursiveDataToInsert);

                if(!$insertQuestionDiscursive){
                    return false;
                }

                $this->questionDiscursiveDAO->commitTransaction();

                
            }

            $this->questionDAO->closeConnection();
            $this->questionTextDAO->closeConnection();
            $this->questionAlternativeDAO->closeConnection();
            $this->questionDiscursiveDAO->closeConnection();

            return true;
        } catch (Exception $e) {

            throw $e;
        }
    }

    /**
     * Get all questions 
     * 
     * @return array $questions
     */
    public function getAllQuestions(){

        try {
            
            $questions = $this->questionDAO->getAllQuestions();

            $questions = array_map(function($q){

                return [
                   'idQuestion' => $q->getIdQuestion(),
                   'text' => $this->questionTextDAO->getQuestionTextsByIdQuestion($q->getIdQuestion())[0]->getText() 
                ] ;

            }, $questions);

            return $questions;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
