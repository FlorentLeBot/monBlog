<?php

namespace App\Models;

use PDO;

use Database\DBConnection;

abstract class Model
{

    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    // fonction pour préparer ou non les requetes en fonction de $single
    public function query(string $sql, int $param = null, bool $single = null)
    {
        // si le paramètre est null c'est une query sinon un prepare
        $method = is_null($param) ? 'query' : 'prepare';
        // strpos : chercher dans un chaîne de caractère
        if (
            strpos($sql, 'DELETE') === 0
            || strpos($sql, 'UPDATE') === 0
            || strpos($sql, 'CREATED') === 0
        ) {
            $statement = $this->db->getPDO()->$method($sql);
            // récupération de la classe en cours
            $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $statement->execute([$param]);
        }
        // si single est null alors on fait un fetchAll sinon un fetch
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';
        $statement = $this->db->getPDO()->$method($sql);
        // récupération de la classe en cours
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        //  si $method est strictement égal à query ça retourne un fetchAll
        if ($method === 'query') {
            return $statement->$fetch();
        } else {
            // sinon on exécute la requête préparée puis on retourne un fetch
            $statement->execute([$param]);
            return $statement->$fetch();
        }
    }
    // fonction générique permettant la récupération de donnée de manière dynamique
    public function allData(): array
    {
        return $this->query("SELECT * 
                            FROM {$this->table} 
                            ORDER BY created_at DESC");
    }
    public function findById(int $id): Model
    {
        // requete preparée pour récupérer des données en fonction de l'id
        return $this->query("SELECT * 
                            FROM {$this->table}
                            WHERE id = ?", $id, true);
    }
    public function delete(int $id): bool
    {
        return $this->query("DELETE FROM {$this->table}
                            WHERE id = ?", $id);
    }
}
