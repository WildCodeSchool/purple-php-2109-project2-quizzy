<?php

namespace App\Model;

class QuestionManager extends AbstractManager
{
    public const TABLE = 'question';

    public function selectRandomQuestion(): array
    {
        $query = ("SELECT * FROM " . static::TABLE . " ORDER BY rand() LIMIT 1");
        return $this->pdo->query($query)->fetch();
    }
}
