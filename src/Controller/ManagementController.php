<?php

namespace App\Controller;

class ManagementController extends AbstractController
{
    public function showFormAddQuestion(): string
    {
        $errors = [];
        $question = "";
        $answerArray = [];
        $numberCorrectAnswers = 0;
        $numberOfAnswers = 1;

        if (!empty($_POST)) { // If a question is being sent, it has to be checked then added.
            if (isset($_POST["question"])) {
                $question = $_POST["question"];
            } else {
                $errors[] = "Il faut remplir le champ question.";
            }
            // This pulls the answers from the form and add them to $answerArray
            while (isset($_POST["answer_" . strval($numberOfAnswers)])) {
                $answer = $_POST["answer_" . strval($numberOfAnswers) ];
                $isCorrect = isset($_POST["answer_" . strval($numberOfAnswers) . "_correct"]);
                $answerArray[] = ["answer" => $answer, "isCorrect" => $isCorrect];
                $numberOfAnswers++;
            }
            foreach ($answerArray as $answer) { // This checks if answer forms are filled properly.
                if (empty($answer["answer"])) {
                    $errors[] = "Tout les champs réponses doivent être remplis.";
                }
                if ($answer["isCorrect"]) { // This checks if at least one answer is correct.
                    $numberCorrectAnswers++ ;
                }
            }

            $errors = $this->verifyNumberOfRightAnswer($numberCorrectAnswers, $numberOfAnswers, $errors);

            if (empty($errors)) {
                // Question is added in the database here
            } else {
                return $this->twig->render('Management/add-question.html.twig', [
                    'errors' => $errors,
                    'question' => $question,
                    'answerArray' => $answerArray,
                ]);
            }
        }

        return $this->twig->render('Management/add-question.html.twig', [
            'errors' => [],
            'question' => "",
            'answerArray' => [["", false],["", false]],
            ]);
    }

    public function verifyNumberOfRightAnswer($numberCorrectAnswers, $numberOfAnswers, $errors)
    {
        if ($numberCorrectAnswers === 0) {
            $errors[] = "Au moins une réponse doit être marquée comme correcte.";
        } elseif ($numberCorrectAnswers === $numberOfAnswers - 1) {
            $errors[] = "Au moins une réponse doit être marquée comme fausse.";
        }

        return $errors;
    }
}
