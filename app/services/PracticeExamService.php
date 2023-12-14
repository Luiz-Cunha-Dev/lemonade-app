<?php

namespace app\services;

use app\daos\QuestionDAO;
use app\daos\QuestionAlternativeDAO;
use app\daos\QuestionDiscursiveDAO;
use app\daos\QuestionTextDAO;
use app\daos\PracticeExamQuestionDao;
use app\daos\PracticeExamDao;

use Exception;
use mysqli_sql_exception;

define("NUMBER_OF_ALTERNATIVES", 5);

/**
 * Practice exam Service
 * 
 * Responsible for orchestrating business rules in the  practice exam 
 * 
 * @package app\services
 */
class PracticeExamService extends AbstractService
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
     * Practice exam question DAO
     * @var practiceExamQuestionDAO $practiceExamQuestionDAO
     */
    private $practiceExamQuestionDAO;

    /**
     * Practice exam DAO
     * @var practiceExamDAO $practiceExamDAO
     */
    private $practiceExamDAO;


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
        $this->practiceExamQuestionDAO = new PracticeExamQuestionDAO($this->conn->getConnection());
        $this->practiceExamDAO = new PracticeExamDao($this->conn->getConnection());
    }

    /**
     * Get and handle user practice exam questions
     * 
     * @param integer idPracticeExam 
     * 
     * @return $jsonQuestions
     */
    public function getPracticeExamQuestions($idPracticeExam)
    {
        try {

            // get practice exam questions
            $practiceExamQuestions = $this->practiceExamQuestionDAO->getPracticeExamQuestionsByIdPracticeExam($idPracticeExam);

            // get id questions from practice exam questions
            $idQuestions = array_map(function ($q) {
                return $q->getIdQuestion();
            }, $practiceExamQuestions);

            $numberOfQuestions = count($idQuestions);

            for ($i = 0; $i < $numberOfQuestions; $i++) {

                // get question texts
                $questionTexts[$i] = $this->questionTextDAO->getQuestionTextsByIdQuestion($idQuestions[$i]);

                // get questions
                $questions[$i] = $this->questionDAO->getQuestionById($idQuestions[$i]);

                if ($questions[$i]->getIdQuestionType() == 1) {

                    // get questions alternatives 
                    $questionAlternatives[$i] = $this->questionAlternativeDAO->getQuestionAlternativesByIdQuestion($idQuestions[$i]);
                } else {
                    $questionsDiscursive[$i] = $this->questionDiscursiveDAO->getQuestionDiscursiveByIdQuestion($questions[$i]->getIdQuestion());
                }
            }

            // Generate an array containing JSON representations of the properties for each question alternative or discursive question
            for ($i = 0; $i < $numberOfQuestions; $i++) {

                if ($questions[$i]->getIdQuestionType() == 1) {

                    $jsonQuestionAlternatives[$i] = array_map(function ($qa) {
                        return [

                            'idQuestionAlternative' => $qa->getIdQuestionAlternative(),
                            'text' => $qa->getText(),
                            'isCorrect' => $qa->getIsCorrect()
                        ];
                    }, $questionAlternatives[$i]);
                } else {

                    $jsonQuestionsDiscursive[$i] =  [
                        'idQuestionDiscursive' => $questionsDiscursive[$i]->getIdQuestionDiscursive(),
                        'baseResponse' => $questionsDiscursive[$i]->getbaseResponse()
                    ];
                }
            }

            // Generate a json with the necessary properties to build a question on client side
            for ($i = 0; $i < $numberOfQuestions; $i++) {

                if ($questions[$i]->getIdQuestionType() == 1) {
                    $jsonQuestions[$i] = array_merge(

                        ['idQuestion' => $questions[$i]->getIdQuestion()],
                        ['statement' => $questions[$i]->getStatement()],
                        ['text' => $questionTexts[$i][0]->getText()],
                        ['alternatives' => $jsonQuestionAlternatives[$i]]
                    );
                } else {
                    $jsonQuestions[$i] = array_merge(

                        ['idQuestion' => $questions[$i]->getIdQuestion()],
                        ['statement' => $questions[$i]->getStatement()],
                        ['text' => $questionTexts[$i][0]->getText()],
                        ['baseResponse' => $jsonQuestionsDiscursive[$i]]
                    );
                }
            }

            $this->practiceExamQuestionDAO->closeConnection();
            $this->questionTextDAO->closeConnection();
            $this->questionDAO->closeConnection();
            $this->questionAlternativeDAO->closeConnection();
            $this->questionDiscursiveDAO->closeConnection();

            return  $jsonQuestions;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get and handle user practice exams
     * 
     * @return array $practiceExams
     */
    public function getAllPracticeExams()
    {
        try {

            $practiceExams = $this->practiceExamDAO->getAllPracticeExams();
            if (!$practiceExams) {
                return array();
            }

            $this->practiceExamDAO->closeConnection();

            return $practiceExams;
        } catch (Exception $e) {
            throw $e;
        };
    }

    /**
     * Insert user practice exam
     * 
     * @param array $practiceExamData
     * 
     * @return boolean
     */
    public function insertUserCreatedPracticeExam($practiceExamData){

        try {


            $practiceExamDataToInsert = [
                'idPracticeExam' => null,
                'name' => $practiceExamData['name'],
                'description' => $practiceExamData['description']
            ];

            $this->practiceExamDAO->beginTransaction();

            $insertUserCreatedPracticeExam = $this->practiceExamDAO->insertPracticeExam($practiceExamDataToInsert);

            if(!$insertUserCreatedPracticeExam){
                return false;
            } 
            
            $this->practiceExamDAO->commitTransaction();

            $idPracticeExam = $this->practiceExamDAO->getMostRecentIdPracticeExam();
            
            $idPracticeExam = $idPracticeExam['idPracticeExam'];

            $this->practiceExamQuestionDAO->beginTransaction();

            for($i = 0; $i < count($practiceExamData['questions']); $i++){

                $this->practiceExamQuestionDAO->insertPracticeExamQuestion([
                    'idPracticeExam' => $idPracticeExam,
                    'idQuestion' => $practiceExamData['questions'][$i]
                ]);
            }

            $this->practiceExamQuestionDAO->commitTransaction();
            
            $this->practiceExamDAO->closeConnection();
            $this->practiceExamQuestionDAO->closeConnection();
            return true;
        } catch (Exception$e) {
            throw $e;
            
        }
    }
}
