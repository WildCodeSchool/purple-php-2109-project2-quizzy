<?php

namespace App\Model;

class AdminManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectUserAdmin(): array
    {
        $query = ('SELECT * FROM ' . static::TABLE . ' WHERE is_admin = true');
        return $this->pdo->query($query)->fetch();
    }

    public function allQuestionNotAdmitted(): array
    {
        $query = ('SELECT * FROM question WHERE is_admitted = false');
        return $this->pdo->query($query)->fetch();
    }
}
