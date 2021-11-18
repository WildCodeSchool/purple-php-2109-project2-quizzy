<?php

namespace App\Model;

class ErrorReportManager extends AbstractManager
{
    public CONST TABLE = 'report';
    /**
     * Add a comment associated to a report
     */
    public function addError(string $title, int $idQuestion)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . self::TABLE . ' (title, id_question) VALUES (:title, :id)');
        $statement->bindValue(':title', $title, \PDO::PARAM_STR);
        $statement->bindValue(':id', $idQuestion, \PDO::PARAM_INT);
        return $statement->execute();
    }
}