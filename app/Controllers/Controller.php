<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller

{
    protected $db;

    public function __construct(DBConnection $db)
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $this->db = $db;
    }
    // fonction view avec en premier paramètre le chemin et en second un paramètre optionnel
    // exemple récupération de l'id dans BlogController / function show()
    protected function view(string $path, array $params = null)
    {
        // donnée temporairement mise en tampon (non lu par le navigateur)
        ob_start();
        // modification du chemin
        // je change les . par un DIRECTORY_SEPARATOR dans la variable path
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        // concaténation de la constante VIEWS (public/index.php) avec le chemin et l'extension .php
        require VIEWS . $path . '.php';
        // lit le contenu courant du tampon puis l'efface
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }
    // fonction permettant de récupérer la connexion à la base de donnée

    protected function getDB()
    {
        return $this->db;
    }
    protected function isAdmin(){
        if(isset($_SESSION['authentication']) && $_SESSION['authentication'] === 1){
            return true ;
        }else{
            return header('Location: /monblog/login');
        }
    }
}
