<?php

namespace App\Controller;

class SuccessController extends AbstractController
{
    public function success()
    {
        if (isset($_SESSION['score'])) {
            $score = $_SESSION['score'];
            $this->unsetUserSession();
            return $this->twig->render('Question/success.html.twig', ['score' => $score]);
        } else {
            header("Location:/");
        }
    }

    public function unsetUserSession(): void
    {
        unset($_SESSION['questionsWellAnswered']);
        unset($_SESSION['score']);
    }
}
