<?php

namespace App\Models;

use DateTime;

class Post extends Model
{
    protected string $table = 'post';

    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    public function getExcerpt(): string
    {
        return substr($this->content, 0, 200) . '...';
    }

    public function getButton(): string
    {
        return <<<HTML
        <a href="/posts/$this->id" class="btn btn-primary">Lire l'article</a>
HTML;
    }

    public function getTags()
    {
        return $this->query('SELECT t.* FROM tag t
        INNER JOIN post_tag pt ON pt.tag_id = t.id
        WHERE pt.post_id = ?', [$this->id]);
    }
}