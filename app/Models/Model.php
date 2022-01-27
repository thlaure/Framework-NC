<?php

namespace App\Models;

use PDO;
use Database\DBConnection;

abstract class Model
{
    protected DBConnection $db;
    protected string $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    }

    public function findById(int $id): self
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", $id, true);
    }

    public function query(string $queryString, int $param = null, bool $single = null)
    {
        $method = $param === null ? 'query' : 'prepare';
        $fetch = $single === null ? 'fetchAll' : 'fetch';

        $stmt = $this->db->getPDO()->$method($queryString);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if ($method === 'query') {
            return $stmt->$fetch();
        } else {
            $stmt->execute([$param]);
            return $stmt->$fetch();
        }
    }
}