<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswersManager;
use App\Model\ItemManager;

class QuestionController extends AbstractController
{
    public function show(): string
    {
        //Function to send one question and its answers to the view Question/index
        $questionManager = new QuestionManager();
        $question = $questionManager->selectRandomQuestion();
        $idQuestion = $question['id']; // fetch the id of the question selected
        $answersManager = new AnswersManager();
        $answers = $answersManager->selectAnswersForQuestion($idQuestion);
        shuffle($answers);
        $_SESSION["question"] = $question;
        $_SESSION["answers"] = $answers;
        return $this->twig->render('Question/index.html.twig', [
            'question' => $question,
            'answers' => $answers,
            'session' => $_SESSION,
        ]);
    }

    public function showResults()
    {
        if (isset($_SESSION['question']) && isset($_SESSION['answers'])) {
            $question = $_SESSION['question'];
            $answers = $_SESSION['answers'];
            return $this->twig->render('Question/result.html.twig', [
                'question' => $question,
                'answers' => $answers,
            ]);
        } else {
            header('Location:/');
            //maybe add a new page error to explain that the website needs cookies to function ?
        }
    }
}
