<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswersManager;
use App\Model\ItemManager;

class LegalNoticesController extends AbstractController
{
    public function legalNotices(): string
    {
        return $this->twig->render('legalnotices.html.twig');
    }
}
