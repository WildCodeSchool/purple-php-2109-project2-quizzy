<?php

namespace App\Model;

class ManagementManager extends AbstractManager
{
    public function getAnswersFromForm(int $numberofAnswers = 1)
    {
        $answerArray = [];
        $numberOfAnswers = $numberofAnswers;
        while (isset($_POST["answer_" . strval($numberOfAnswers)])) {
            $answer = $_POST["answer_" . strval($numberOfAnswers) ];
            $isCorrect = isset($_POST["answer_" . strval($numberOfAnswers) . "_correct"]);
            $answerArray[] = ["answer" => $answer, "isCorrect" => $isCorrect];
            $numberOfAnswers++;
        }

        return $answerArray;
    }

    public function verifyNumberOfRightAnswer(int $numberCorrectAnswers, int $numberOfAnswers, array $errors)
    {
        if ($numberCorrectAnswers === 0) {
            $errors[] = "Au moins une réponse doit être marquée comme correcte.";
        } elseif ($numberCorrectAnswers === $numberOfAnswers) {
            $errors[] = "Au moins une réponse doit être marquée comme fausse.";
        }

        return $errors;
    }
}
