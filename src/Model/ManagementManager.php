<?php

namespace App\Model;

class ManagementManager extends AbstractManager
{
    public function getAnswersFromForm(int $idOfAnswer = 1)
    {
        /* This get the sent form and checks for the answers in it. Since a form doesn't have a set number
        of answers, this needs to check if an answer exists and then add it in a array.
        This function is also used in the approval question form, so answers will already have an id.
        It creates a lot of answers in the form of an unkeyed array, that have answers on the form of a keyed array.
        */
        $answerArray = [];
        $idOfAnswer = $idOfAnswer;
        while (isset($_POST["answer_" . strval($idOfAnswer)])) {
            $answer = $_POST["answer_" . strval($idOfAnswer) ];
            $isCorrect = isset($_POST["answer_" . strval($idOfAnswer) . "_correct"]);
            $answerArray[] = ["answer" => $answer, "isCorrect" => $isCorrect];
            $idOfAnswer++;
        }

        return $answerArray;
    }


    public function verifyAnswersFromForm(array $answerArray)
    {
        $numberCorrectAnswers = 0;
        $numberOfAnswers = count($answerArray);
        $answerTitleArray = [];
        $errors = [];

        foreach ($answerArray as $answer) { // This checks if answer forms are filled properly.
            if (empty($answer["answer"])) {
                if (!in_array("Tous les champs réponses doivent être remplis.", $errors)) {
                    $errors[] = "Tous les champs réponses doivent être remplis.";
                }
            }
            if (in_array($answer["answer"], $answerTitleArray)) { // This checks if an answer is a duplicate.
                if (!in_array("Veillez à ce que les réponses soient toutes différents.", $errors)) {
                    $errors[] = "Veillez à ce que les réponses soient toutes différents.";
                }
            }
            $answerTitleArray[] = $answer["answer"];
            if ($answer["isCorrect"]) { // This checks if at least one answer is correct.
                $numberCorrectAnswers++ ;
            }
        }

        $errors = $this->checkNumberOfErrors($numberCorrectAnswers, $numberOfAnswers, $errors);

        return $errors;
    }

    public function checkNumberOfErrors(int $numberCorrectAnswers, int $numberOfAnswers, array $errors)
    {
        if ($numberCorrectAnswers === 0) {
            $errors[] = "Au moins une réponse doit être marquée comme correcte.";
        } elseif ($numberCorrectAnswers === $numberOfAnswers) {
            $errors[] = "Au moins une réponse doit être marquée comme fausse.";
        }

        if ($numberOfAnswers > 4) { // As of now the layout can't handle more than 4 answers.
            $errors[] = "Vous ne pouvez pas envoyer plus de 4 réponses.";
        } elseif ($numberOfAnswers < 2) {
            $errors[] = "Vous ne pouvez pas envoyer moins de 2 réponses.";
        }
    }
}
