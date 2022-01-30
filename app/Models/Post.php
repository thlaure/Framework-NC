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

    public function update(int $id, array $data, ?array $relations = null): bool
    {
        parent::update($id, $data);
        $stmt = $this->db->getPDO()->prepare('DELETE FROM post_tag WHERE post_id = ?');
        $result = $stmt->execute([$id]);

        $nbRelations = count($relations);
        $queryPart = '';
        for ($i = 1; $i <= $nbRelations; ++$i) {
            $comma = $i === $nbRelations ? '' : ', ';
            $queryPart .= "({$id}, {$relations[$i - 1]}){$comma}";
        }
        $this->db->getPDO()->query("INSERT INTO post_tag (post_id, tag_id) VALUES {$queryPart}");
        if ($result) {
            return true;
        }
    }
}