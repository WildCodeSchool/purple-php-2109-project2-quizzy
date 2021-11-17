<?php

namespace App\Model;

class AnswersManager extends AbstractManager
{
    public const TABLE = 'answer';

    public function selectAnswersForQuestion($id)
    {
        //fetch all the answers for a question ID
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

    public function selectAnswerFromChecked($id)
    {
        //Fetch in the database the answer that had been clicked
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
