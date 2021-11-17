<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswersManager;

class ErrorReportingController extends AbstractController
{
    /**
     * This controller ask for details about an error report on a question.
     * $id : the reported question id.
     */
    public function addMessage(int $id): string
    {
        $questionManager = new QuestionManager();
        $question = $questionManager->selectOneById($id);
        // Check if question id exists in database.
        if (false === $question) {
            header('location: /');
            return '';
        }
        return $this->twig->render('errorReporting/addMessage.html.twig', [
            'question' => $question
        ]);
    }
}
