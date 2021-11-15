<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswersManager;

class QuestionController extends AbstractController
{
    public function show()
    {
        $questionManager = new QuestionManager();
        $count = $questionManager->countAllQuestions();
        $countTotal = intval($count['total']);
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = 0;
        }
        if (!isset($_SESSION["questionsWellAnswered"])) {
            $_SESSION["questionsWellAnswered"] = [];
        }
        if (empty($_SESSION["questionsWellAnswered"])) {
            //if it's the beginning of the session, we select a random question
            $question = $questionManager->selectRandomQuestion();
        } elseif (
            (!empty($_SESSION["questionsWellAnswered"]) && (count($_SESSION["questionsWellAnswered"]) < $countTotal))
        ) {
            // Transform the array into a string to send it as a parameter for the SQL request
            $askedQuestionsList = implode(",", $_SESSION["questionsWellAnswered"]);
            $question = $questionManager->selectRandomQuestion($askedQuestionsList);
        } elseif (
            !empty($_SESSION["questionsWellAnswered"]) && (count($_SESSION["questionsWellAnswered"]) == $countTotal)
        ) {
            // if the user answered to all the questions in the database, he's redirected
            header("Location:/success");
        }
        if (isset($question['id'])) {
            // Fetch the id of the question selected
            $idQuestion = $question['id'];
            // Fetch answers for the question id
            $answersManager = new AnswersManager();
            $answers = $answersManager->selectAnswersForQuestion($idQuestion);
            shuffle($answers);
            // Stock the variables in $_Session to fetch them in the result page
            $_SESSION["question"] = $question;
            $_SESSION["answers"] = $answers;
            return $this->twig->render('Question/index.html.twig', [
                'question' => $question,
                'answers' => $answers,
                'session' => $_SESSION,
            ]);
        }
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
                //&& !in_array($questionId, $_SESSION["questionsWellAnswered"])
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
}
