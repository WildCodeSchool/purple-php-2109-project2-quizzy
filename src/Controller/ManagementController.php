<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswersManager;
use App\Model\ItemManager;
use App\Model\ManagementManager;

class ManagementController extends AbstractController
{
    public function showFormAddQuestion(): string
    {
        $errors = [];
        $question = "";
        $answerArray = [];
        $managementManager = new ManagementManager();

        if (!empty($_POST)) { // If a question is being sent, it has to be checked then added.
            if (isset($_POST["question"])) {
                $question = $_POST["question"];
            } else {
                $errors[] = "Il faut remplir le champ question.";
            }


            // This pulls the answers from the form and add them to $answerArray
            $answerArray = $managementManager->getAnswersFromForm();

            $errors = $managementManager->verifyAnswersFromForm($answerArray);

            if (empty($errors)) {
                $questionManager = new QuestionManager();
                $questionId = $questionManager->addQuestion($question);
                $answersManager = new AnswersManager();
                $answersManager->addAnswers($answerArray, $questionId);
            } else {
                // If the user sent a faulty form, we inform of the errors and then back what they wrote.
                return $this->twig->render('Management/add-question.html.twig', [
                    'errors' => $errors,
                    'question' => $question,
                    'answerArray' => $answerArray,
                ]);
            }
        }

        // When we want the user to get a blank form, we initialize the content of the form with two empty answers.
        return $this->twig->render('Management/add-question.html.twig', [
            'errors' => [],
            'question' => "",
            'answerArray' => [["", false],["", false]],
            ]);
    }
}
