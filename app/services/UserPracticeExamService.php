<?php

namespace app\services;

use app\daos\UserPracticeExamDAO;
use app\daos\UserPracticeExamQuestionAlternativeDAO;
use app\daos\QuestionDAO;
use app\daos\QuestionAlternativeDAO;
use app\daos\QuestionTextDAO;
use app\daos\PracticeExamQuestionDao;
use app\models\UserPracticeExamModel;
use Exception;

define("NUMBER_OF_ALTERNATIVES", 5);

use mysqli_sql_exception;

/**
 * User practice exam Service
 * 
 * Responsible for orchestrating business rules in the user practice exam question
 * 
 * @package app\services
 */
class UserPracticeExamService extends AbstractService
{
    private $userPracticeExamDAO;
    private $userPracticeExamQuestionAlternativeDAO;
    private $questionDAO;
    private $questionAlternativeDAO;
    private $questionTextDAO;
    private $practiceExamQuestionDAO;



    public function __construct()
    {
        parent::__construct();
        $this->userPracticeExamDAO = new UserPracticeExamDAO($this->conn->getConnection());
        $this->userPracticeExamQuestionAlternativeDAO = new UserPracticeExamQuestionAlternativeDAO($this->conn->getConnection());
        $this->questionDAO = new QuestionDAO($this->conn->getConnection());
        $this->questionAlternativeDAO = new QuestionAlternativeDAO($this->conn->getConnection());
        $this->questionTextDAO = new QuestionTextDAO($this->conn->getConnection());
        $this->practiceExamQuestionDAO = new PracticeExamQuestionDAO($this->conn->getConnection());
    }

    public function startUserPracticeExam($userPracticeExamStartData)
    {

        $userPracticeExam = array_merge(
            ['idUserPracticeExam' => null],
            ['startDate' => $userPracticeExamStartData['startDate']],
            ['endDate' => null],
            ['grade' => null],
            ['idUser' => $userPracticeExamStartData['idUser']],
            ['idPracticeExam' => $userPracticeExamStartData['idPracticeExam']]
        );

        $userPracticeExam = new UserPracticeExamModel(...array_values($userPracticeExam));

        try {

            $this->userPracticeExamDAO->beginTransaction();

            $insertUserPracticeExam = $this->userPracticeExamDAO->insertUserPracticeExam($userPracticeExam);

            if (!$insertUserPracticeExam) {
                return false;
            }

            $this->userPracticeExamDAO->commitTransaction();

            $idUser = $userPracticeExamStartData['idUser'];

            $idPracticeExam = $userPracticeExamStartData['idPracticeExam'];

            $idUserPracticeExam = $this->userPracticeExamDAO->getUserPracticeExamsByIdUserAndIdUserPracticeExam($idUser, $idPracticeExam);

            $this->userPracticeExamDAO->closeConnection();

            return array('idUserPracticeExam' => $idUserPracticeExam->getIdUserpracticeExam());

        } catch (mysqli_sql_exception $e) {
            $this->userPracticeExamDAO->rollbackTransaction();
            throw $e;
        }
    }

    public function getUserPracticeExamQuestions($idPracticeExam)
    {
        try {

            // get practice exam questions
            $practiceExamQuestions = $this->practiceExamQuestionDAO->getPracticeExamQuestionsByIdpracticeExam($idPracticeExam);

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

                // get questions alternatives 
                $questionAlternatives[$i] = $this->questionAlternativeDAO->getQuestionAlternativesByIdQuestion($idQuestions[$i]);
    
            }

            // Generate an array containing JSON representations of the properties for each question alternative
            for ($i = 0; $i < $numberOfQuestions; $i++) {
                $jsonQuestionAlternatives[$i] = array_map(function ($qa) {
                    return [

                            'idQuestionAlternative' => $qa->getIdQuestionAlternative(),
                            'letter' => $qa->getLetter(),
                            'text' => $qa->getText(),
                            'isCorrect' => $qa->getIsCorrect()
                    ];
                }, $questionAlternatives[$i]);
            }

            // Generate a json with the necessary properties to build a question on client side
            for ($i = 0; $i < $numberOfQuestions; $i++) {

                $jsonQuestionsAndAlternatives[$i] = array_merge(
                    
                        ['idQuestion' => $questions[$i]->getIdQuestion()],
                        ['statement' => $questions[$i]->getStatement()],
                        ['text' => $questionTexts[$i][0]->getText()],
                        ['alternatives' => $jsonQuestionAlternatives[$i]]
                );
            }

            $this->practiceExamQuestionDAO->closeConnection();
            $this->questionTextDAO->closeConnection();
            $this->questionDAO->closeConnection();
            $this->questionAlternativeDAO->closeConnection();

            return  $jsonQuestionsAndAlternatives;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insertUserPracticeExamQuestionAlternative($userPracticeExamQuestionAlternativeData) {

        try {

            $this->userPracticeExamQuestionAlternativeDAO->beginTransaction();

            $insertUserQuestionAlternative = $this->userPracticeExamQuestionAlternativeDAO->insertUserPracticeExamQuestionAlternative($userPracticeExamQuestionAlternativeData);

            $this->userPracticeExamQuestionAlternativeDAO->commitTransaction();

            $this->userPracticeExamQuestionAlternativeDAO->closeConnection();

            return $insertUserQuestionAlternative;
        } catch (mysqli_sql_exception $e) {
            $this->userPracticeExamDAO->rollbackTransaction();
            throw $e;
        }
    }
}
