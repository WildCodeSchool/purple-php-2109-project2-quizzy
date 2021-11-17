<?php

namespace App\Model;

use App\Model\AnswersManager;

class AdminManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectUserAdmin(): array
    {
        $query = ('SELECT * FROM ' . static::TABLE . ' WHERE is_admin = true');
        return $this->pdo->query($query)->fetch();
    }

    public function isAdminConnected(): void
    {
        /* This function checks if the user is an admin. As of now, since there is only of user
        and it is the admin, we only check if the session is set. */
        if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
            header('Location: login');
        }
    }

    public function createArrayNonAdmittedQuestions(array $questions): array
    {
        // When questions are admitted they have to be reviewed, this pull those questions.
        $answersManager = new AnswersManager();

        $questionsAndAnswers = [];
        foreach ($questions as $question) {
            $questionArray = [
                'title' => $question["title"],
                'id' => $question["id"],
                'answers' => $answersManager->selectAnswersForQuestion($question["id"])
            ];
            $questionsAndAnswers[] = $questionArray;
        }
        return $questionsAndAnswers;
    }
}
