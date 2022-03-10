<?php

namespace Router;

use Database\DBConnection;

class Route
{
    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        // je retire les slash en au début et à la fin du chemin
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        // création d'un nouveau chemin
        $path = preg_replace('#:([\w]+)#', '([¨^/]+)', $this->path);
        $pathToMatch = "#^$path$#";
        // si il y a une correspondance avec l'expression régulière 
        if (preg_match($pathToMatch, $url, $matches)) {
            // retourne vrai
            $this->matches = $matches;
            var_dump($this->matches);
            return true;
        } else {
            // sinon retourne faux
            return false;
        }
    }
    public function execute()
    {
        // je scinde l'action (ex : BlogController&index) défini dans l'index.php 
        // pour isoler la méthode défini dans le BlogController

        $params = explode('&', $this->action);
        //var_dump($params);
        // création d'une nouvelle instance de blogController 
        // TO DO variable d'environnement DB_NAME DB_HOST DB_USER DB_PWD
        // instanciation de la classe DB
        $controller = new $params[0](new DBConnection('monapp', 'localhost', 'root', ''));
        //var_dump($controller);
        // la méthode isolée ci-dessus
        $method = $params[1];
        //var_dump($method);
        //var_dump($this->matches[1]);
        // si il y a une correspondance alors va chercher la méthode 
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}
