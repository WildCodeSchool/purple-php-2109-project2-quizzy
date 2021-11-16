<?php

namespace App\Model;

class AnswersManager extends AbstractManager
{
    public const TABLE = 'answer';

    public function selectAnswersForQuestion($id): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id_question=:id_question");
        $statement->bindValue('id_question', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function addAnswers(array $answers, int $questionId): void
    {
        $query = "INSERT INTO " . static::TABLE . " (title, is_correct, id_question) 
        VALUES (:answer, :is_correct, :questionId)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':questionId', $questionId, \PDO::PARAM_INT);

        foreach ($answers as $answer) {
            $statement->bindValue(':answer', $answer["answer"], \PDO::PARAM_STR);
            $statement->bindValue(':is_correct', $answer["isCorrect"], \PDO::PARAM_BOOL);
            $statement->execute();
        }
    }

    public function updateAnswers(array $answers, int $firstAnswerId): void
    {
        $currentId = $firstAnswerId;
        $query = "UPDATE " . static::TABLE . " SET title = :title, is_correct = :isCorrect WHERE id = :id";
        foreach ($answers as $answer) {
            $statement = $this->pdo->prepare($query);

            $statement->bindValue(':title', $answer["answer"], \PDO::PARAM_STR);
            $statement->bindValue(':isCorrect', $answer["isCorrect"], \PDO::PARAM_BOOL);
            $statement->bindValue(':id', $currentId, \PDO::PARAM_INT);
            $statement->execute();
            $currentId += 1;
        }
    }

    public function deleteAnswers(int $questionId): void
    {
        $query = "DELETE " . static::TABLE . " WHERE id_question = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $questionId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
