<?php

namespace app\services;

use app\daos\UserPracticeExamDAO;
use app\daos\UserPracticeExamQuestionAlternativeDAO;
use app\daos\QuestionAlternativeDAO;

use app\models\UserPracticeExamQuestionAlternativeModel;
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
    /**
     * User practice exam DAO
     * @var UserPracticeExamDAO $userPracticeExamDAO
     */
    private $userPracticeExamDAO;

    /**
     * User practice exam question alternative DAO
     * @var UserPracticeExamQuestionAlternativeDAO $userPracticeExamQuestionAlternativeDAO
     */
    private $userPracticeExamQuestionAlternativeDAO;
    
    /**
     * Question alternative DAO
     * @var questionAlternativeDAO $questionAlternativeDAO
     */
    private $questionAlternativeDAO;

    /**
     * Class constructor
     * 
     * Return a new UserPracticeExam instance
     */
    public function __construct()
    {
        parent::__construct();
        $this->userPracticeExamDAO = new UserPracticeExamDAO($this->conn->getConnection());
        $this->userPracticeExamQuestionAlternativeDAO = new UserPracticeExamQuestionAlternativeDAO($this->conn->getConnection());
        $this->questionAlternativeDAO = new QuestionAlternativeDAO($this->conn->getConnection());
    }

    /**
     * Get all user practice exams by idUser
     * 
     * @param integer $idUser user id
     * 
     * @return array $userPracticeExams
     */
    public function getAllUserPracticeExamsByIdUser($idUser){
        try {

            $userPracticeExams = $this->userPracticeExamDAO->getAllUserPracticeExamsByIdUser($idUser);
            
            if (!$userPracticeExams) {
                return array();
            }

            $this->userPracticeExamDAO->closeConnection();

            return $userPracticeExams;
        } catch (Exception $e) {
            throw $e;
        };
    }

    /**
     * Insert user practice exam and user practice exam questions alternatives in to database 
     * @param array $userPracticeExam
     */
    public function finishUserPracticeExam($userPracticeExamData)
    {
        //Build array with user practice exam data and convert in to model
        $userPracticeExam = array_merge(
            ['idUserPracticeExam' => null],
            ['startDate' => $userPracticeExamData['startDate']],
            ['endDate' => $userPracticeExamData['endDate']],
            ['grade' => null],
            ['idUser' => $userPracticeExamData['idUser']],
            ['idPracticeExam' => $userPracticeExamData['idPracticeExam']]
        );

        $userPracticeExam = new UserPracticeExamModel(...array_values($userPracticeExam));

        try {

            //insert user practice exam on database
            $this->userPracticeExamDAO->beginTransaction();

            $insertUserPracticeExam = $this->userPracticeExamDAO->insertUserPracticeExam($userPracticeExam);

            if (!$insertUserPracticeExam) {
                return false;
            }

            $this->userPracticeExamDAO->commitTransaction();

            //get id user practice exam
            $idUserPracticeExam = $this->userPracticeExamDAO->getUserPracticeExamsByIdUserAndIdUserPracticeExam(
                $userPracticeExamData['idUser'], 
                $userPracticeExamData['idPracticeExam']
            )->getIdUserPracticeExam();
            
            $this->userPracticeExamQuestionAlternativeDAO->beginTransaction();

            //Create user practice exam question alternative model and insert in to database
            for($i = 0; $i < count($userPracticeExamData['alternatives']); $i++){

                $userPracticeExamQuestionAlternative = new UserPracticeExamQuestionAlternativeModel($idUserPracticeExam, $userPracticeExamData['alternatives'][$i]);
                $insert = $this->userPracticeExamQuestionAlternativeDAO->insertUserPracticeExamQuestionAlternative($userPracticeExamQuestionAlternative);
                if(!$insert){
                    return $insert;
                }
            }
            
            $this->userPracticeExamQuestionAlternativeDAO->commitTransaction();

            //Calculate grade
            $grade = 0;

            foreach ($userPracticeExamData['alternatives'] as $ic){
                $ic = $this->questionAlternativeDAO->getQuestionAlternativeByIdQuestionAlternative($ic)->getIsCorrect();
                if($ic){
                    $grade += 1;
                }
            }

            //Insert grade in to user practice exam table on db
            $userPracticeExamWithGrade = array_merge(
                ['idUserPracticeExam' => null],
                ['startDate' => $userPracticeExamData['startDate']],
                ['endDate' => $userPracticeExamData['endDate']],
                ['grade' => $grade],
                ['idUser' => $userPracticeExamData['idUser']],
                ['idPracticeExam' => $userPracticeExamData['idPracticeExam']]
            );
    
            $userPracticeExamWithGrade = new UserPracticeExamModel(...array_values($userPracticeExamWithGrade));

            $this->userPracticeExamDAO->beginTransaction();

            $updateGrade = $this->userPracticeExamDAO->updateUserPracticeExamById($userPracticeExamWithGrade, $idUserPracticeExam);

            if(!$updateGrade){
                return false;
            }

            $this->userPracticeExamDAO->commitTransaction();

            $this->userPracticeExamDAO->closeConnection();
            $this->userPracticeExamQuestionAlternativeDAO->closeConnection();

            return true;

        } catch (mysqli_sql_exception $e) {
            $this->userPracticeExamDAO->rollbackTransaction();
            throw $e;
        }
    }

}

    

