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
    // fonction générique permettant la récupération de donnée de manière dynamique
    public function allData(): array
    {
        // requete sql recupération des données dans la table posts rangé par la date de publication la plus récente
        $statement = $this->db->getPDO()->query("SELECT title, content, created_at 
                                    FROM {$this->table} 
                                    ORDER BY created_at DESC");
        // mode de récupération pour cette requête (mode de récupération/nom de la classe/argument du constructeur)
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        // je récupére toutes les données
        return $statement->fetchAll();
    }
    public function findById(int $id): Model
    {
        // requete preparée pour récupérer des données en fonction de l'id
        $statement = $this->db->getPDO()->prepare("SELECT id, title, content, created_at 
                                                    FROM {$this->table}
                                                    WHERE id = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $statement->execute([$id]);
        return $statement->fetch();
    }
    
}
