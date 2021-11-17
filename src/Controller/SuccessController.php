<?php

namespace App\Controller;

class SuccessController extends AbstractController
{
    public function success(): string
    {
        $score = $_SESSION['score'];
        self::unsetUserSession();
        return $this->twig->render('Question/success.html.twig', ['score' => $score]);
    }

    public function unsetUserSession(): void
    {
        unset($_SESSION['questionsWellAnswered']);
        unset($_SESSION['score']);
    }
}
