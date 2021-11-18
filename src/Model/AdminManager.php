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

    public function sendImageForAQuestion(): void
    {
        // This sends an image to the question folder if one is sent, for now the extension is changed to .jpg
        if (
            is_uploaded_file($_FILES["image-question"]["tmp_name"]) &&
            substr(mime_content_type($_FILES["image-question"]["tmp_name"]), 0, 5) == "image"
        ) {
            $uploadDir =  __DIR__ . '/../../public/assets/images/questions/';
            $uploadFile = $uploadDir . "question-image-" . strval($_POST['id']) . ".jpg";
            move_uploaded_file($_FILES['image-question']['tmp_name'], $uploadFile);
        }
    }
}
