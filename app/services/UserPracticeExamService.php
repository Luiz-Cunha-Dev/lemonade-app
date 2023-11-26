<?php

namespace app\services;

use app\daos\UserPracticeExamDAO;
use app\daos\UserPracticeExamQuestionAlternativeDAO;
use app\models\UserPracticeExamModel;



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

    public function __construct()
    {
        parent::__construct();
        $this->userPracticeExamDAO = new UserPracticeExamDAO($this->conn->getConnection());
        $this->userPracticeExamQuestionAlternativeDAO = new UserPracticeExamQuestionAlternativeDAO($this->conn->getConnection());
    }

    public function startUserPracticeExam(array $userPracticeExamStartData): array
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

            if(!$insertUserPracticeExam){
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
}
