<?php

namespace App\Model;

class AnswersManager extends AbstractManager
{
    public const TABLE = 'answer';

    public function getAnswersForQuestion($id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id_question=:id_question");
        $statement->bindValue('id_question', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
