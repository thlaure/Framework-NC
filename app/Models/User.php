<?php

namespace App\Models;

class User extends Model
{
    protected string $table = 'user';

    public function getByUsername(string $username): self
    {
        return $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
    }
}