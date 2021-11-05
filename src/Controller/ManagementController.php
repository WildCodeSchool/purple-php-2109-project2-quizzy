<?php

namespace App\Controller;

class ManagementController extends AbstractController
{
    public function showFormAddQuestion(): string
    {
        return $this->twig->render('Management/add-question.html.twig', [
        ]);
    }
}
