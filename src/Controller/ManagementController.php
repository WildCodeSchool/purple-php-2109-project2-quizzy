<?php

namespace App\Controller;

class ManagementController extends AbstractController
{
    public function showFormAddQuestion(): string
    {
        $errors = [];
        $question = "";
        $answerArray = [];
        $minOneCorrectAnswer = false;
        $numberOfAnswers = 1;

        if (!empty($_POST)) { // If a question is being sent, it has to be checked then added.
            if (isset($_POST["question"])) {
                $question = $_POST["question"];
            } else {
                $errors[] = "Il faut remplir le champ question.";
            }
            while (true) { // This pulls the answers from the form and add them to $answerArray
                if (isset($_POST["answer_" . strval($numberOfAnswers)])) {
                    $answer = $_POST["answer_" . strval($numberOfAnswers) ];
                    $isCorrect = isset($_POST["answer_" . strval($numberOfAnswers) . "_correct"]);
                    $answerArray[] = ["answer" => $answer, "isCorrect" => $isCorrect];
                    $numberOfAnswers++;
                } else {
                    break;
                }
            }
            foreach ($answerArray as $answer) { // This checks if answer forms are filled properly.
                if (empty($answer["answer"])) {
                    $errors[] = "Tout les champs réponses doivent être remplis.";
                }
                if ($answer["isCorrect"]) { // This checks if at least one answer is correct.
                    $minOneCorrectAnswer = true;
                }
            }

            if ($minOneCorrectAnswer == false) {
                $errors[] = "Au moins une réponse doit être marquée comme correcte.";
            }

            if (empty($errors)) {
                // Question is added here
            }

            else {
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
}
