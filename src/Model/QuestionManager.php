<?php

namespace App\Model;

class QuestionManager extends AbstractManager
{
    public const TABLE = 'question';

    public function selectRandomQuestion(): array
    {
        $query = ("SELECT * FROM " . static::TABLE . " WHERE is_admitted = true ORDER BY rand() LIMIT 1");
        return $this->pdo->query($query)->fetch();
    }

    public function addQuestion(string $question): int
    {
        $query = "INSERT INTO " . static::TABLE . " (title,  is_admitted) 
        VALUES (:question, false)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':question', $question, \PDO::PARAM_STR);
        $statement->execute();
        return $this->selectLastQuestion()["id"];
    }

    public function selectLastQuestion(): array
    {
        $query = ("SELECT * FROM " . static::TABLE . " ORDER BY id DESC LIMIT 1");
        return $this->pdo->query($query)->fetch();
    }

    public function selectNonAdmittedQuestions(): array
    {
        $query = ("SELECT * FROM " . static::TABLE . " WHERE is_admitted = false ORDER BY id LIMIT 5");
        return $this->pdo->query($query)->fetchAll();
    }

    public function updateQuestion(int $id, string $title): void
    {
        $query = "UPDATE " . static::TABLE .
        " SET title = :title, is_admitted = true
        WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->bindValue(':title', $title, \PDO::PARAM_STR);
        $statement->execute();
    }
}
