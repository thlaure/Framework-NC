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
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function query(string $queryString, array $param = null, bool $single = null)
    {
        $method = $param === null ? 'query' : 'prepare';
        $stmt = $this->db->getPDO()->$method($queryString);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if (strpos($queryString, 'DELETE') === 0 || strpos($queryString, 'UPDATE') === 0 || strpos($queryString, 'INSERT') === 0) {
            return $stmt->execute($param);
        }

        $fetch = $single === null ? 'fetchAll' : 'fetch';

        if ($method === 'query') {
            return $stmt->$fetch();
        } else {
            $stmt->execute($param);
            return $stmt->$fetch();
        }
    }

    public function delete(int $id): bool
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function update(int $id, array $data, ?array $relations = null): bool
    {
        $queryPart = '';
        $i = 1;
        $nbData = count($data);
        foreach ($data as $key => $value) {
            $comma = $i === $nbData ? '' : ', ';
            $queryPart .= "{$key} = :{$key}{$comma}";
            ++$i;
        }
        $data['id'] = $id;
        return $this->query("UPDATE {$this->table} SET {$queryPart} WHERE id = :id", $data);
    }

    public function create(array $data, ?array $relations = null)
    {
        $firstParenthesis = '';
        $secondParenthesis = '';

        $i = 1;
        $nbData = count($data);
        foreach ($data as $key => $value) {
            $comma = $i === $nbData ? '' : ', ';
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            ++$i;
        }
        // var_dump($this->query("INSERT INTO $this->table ($firstParenthesis) VALUE ($secondParenthesis)", $data));die();

        return $this->query("INSERT INTO {$this->table} ($firstParenthesis) VALUE ($secondParenthesis)", $data);
    }
}