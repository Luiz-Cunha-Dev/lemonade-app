<?php

namespace app\controllers\webapp;

use app\services\QuestionService;

class QuestionController {

    public static function getQuestionById($idQuestion) {

        $questionService = new QuestionService();

        $question = $questionService->getQuestionById($idQuestion);

        return $question;
    }

    public static function getQuestionTextsByIdQuestion($idQuestion) {

        $questionService = new QuestionService();

        $texts = $questionService->getQuestionTextsByIdQuestion($idQuestion);

        return $texts;
    }

    public static function getQuestionAlternativesByIdQuestion($idQuestion) {

        $questionService = new QuestionService();

        $alternatives = $questionService->getQuestionAlternativesByIdQuestion($idQuestion);

        return $alternatives;
    }

}
