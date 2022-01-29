<?php

namespace App\Models;

class Tag extends Model
{
    protected string $table = 'tag';

    public function getPosts()
    {
        return $this->query('
            SELECT p.* FROM post p
            INNER JOIN post_tag pt ON pt.post_id = p.id
            WHERE pt.tag_id = ?
        ', [$this->id]);
    }
}