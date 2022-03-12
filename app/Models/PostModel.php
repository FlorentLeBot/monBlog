<?php

namespace App\Models;

use DateTime;

class PostModel extends Model
{
    protected $table = 'posts';

    public function getCreatedAt(): string
    {
        // création d'un nouvelle instance DateTime avec comme paramètre mes created_at 
        // retourne une chaîne de caractère
        // puis je la formate
        return $date = (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }
    public function getExcerpt(): string
    {
        // substr retourne un segnement de la chaîne de caractère
        // paramètre la chaîne de caractère, le début de la chaîne et sa fin
        return substr($this->content, 0, 120) . '...';
    }
    public function getButton(): string
    {
        // syntaxe Heredoc (<<< / un identifiant / une nouvelle ligne / la chaîne de caractère / le même identifiant pour fermer la citation
        return <<<HTML
        <button><a href="/posts/$this->id">Lire plus</a></button>
        HTML;
    }
    public function getTags()
    {
        return $this->query("SELECT t.* FROM tags t
                            INNER JOIN post_tag pt ON pt.tag_id = t.id
                            INNER JOIN posts p ON pt.post_id = p.id
                            WHERE p.id = ?
                            ", [$this->id]);
    }
    public function create(array $data, ?array $relations = null){

        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();

        foreach($relations as $tagId){
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }
        return true;
    }

    public function update(int $id, array $data, ?array $relations = null){

        parent::update($id, $data);

        $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([$id]);
        foreach($relations as $tagId){
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }
        if($result){
            return true;
        }


    }
}
