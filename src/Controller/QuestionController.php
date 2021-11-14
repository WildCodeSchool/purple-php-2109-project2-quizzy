<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswersManager;
use App\Model\ItemManager;

class QuestionController extends AbstractController
{
    public function show(): string
    {
        // Function to send one question and its answers to the view Question/index
        $questionManager = new QuestionManager();
        if (!empty($_SESSION["questionsWellAnswered"])) {
            $alreadyAskedQuestion = $_SESSION["questionsWellAnswered"];
            $count = $questionManager->countAllQuestions();
            if ($count['total'] === count($alreadyAskedQuestion)) {
                self::unsetUserSession();
                header("Location:/");
            }
                // Transform the array into a string to send it as a parameter for the SQL request
            $askedQuestionsList = implode(",", $alreadyAskedQuestion);
            $question = $questionManager->selectRandomQuestion($askedQuestionsList);
        } else {
            $question = $questionManager->selectRandomQuestion();
        }
        // Fetch the id of the question selected
        $idQuestion = $question['id'];
        // Fetch answers for the question id
        $answersManager = new AnswersManager();
        $answers = $answersManager->selectAnswersForQuestion($idQuestion);
        shuffle($answers);
        // Stock the variables in $_Session to fetch them in the result page
        $_SESSION["question"] = $question;
        $_SESSION["answers"] = $answers;
        // check if score exists already and if not, create the index
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = 0;
        }
        // check if the array of questions where answer was correct, is already creates
        if (!isset($_SESSION["questionsWellAnswered"])) {
            $_SESSION["questionsWellAnswered"] = [];
        }
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
            self::checkIfCorrect();
            return $this->twig->render('Question/result.html.twig', [
                'question' => $question,
                'answers' => $answers,
            ]);
        } else {
            header('Location:/');
            //maybe add a new page error to explain that the website needs cookies to function ?
        }
    }

    public static function checkIfCorrect()
    {
        if (!empty($_POST)) {
            //Fetch the keys from post that correspond to the question id and the answer that has been clicked
            $answerChecked = array_keys($_POST);
            if ((isset($answerChecked[0])) && ($answerChecked[0] > 0)) {
                $questionId = $answerChecked[0];
            }
            if ((isset($answerChecked[1])) && ($answerChecked[1] > 0)) {
                $answerId = $answerChecked[1];
            }
            if (isset($questionId) && isset($answerId)) {
                $answersManager = new AnswersManager();
                //Fetch the answer and its properties
                $chosenAnswer = $answersManager->selectAnswerFromChecked($answerId);
                if ($chosenAnswer['is_correct']) {
                    $_SESSION['score'] ++;
                    $_SESSION["questionsWellAnswered"][] = $questionId;
                }
            }
        } else {
            header('Location:/');
        }
    }

    public function unsetUserSession(): void
    {
        unset($_SESSION['questionsWellAnswered']);
        unset($_SESSION['score']);
    }
}
