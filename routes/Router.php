<?php

namespace Router;


class Router
{
    public $url;
    public $routes = [];

    public function __construct($url)
    {
        
        // retirer les slashs en début et fin d'url
        $this->url = trim($url,'/');
    }

    public function getRoute(string $path, string $action)
    {

        $this->routes['GET'][] = new Route($path, $action);
    }

    public function run()
    {


        // REQUEST_METHOD : Méthode de requête utilisée pour accéder à la page ; par exemple ' GET', ' HEAD', ' POST', ' PUT'.
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {

            if ($route->matches($this->url)) {
         
                return $route->execute();
            }
        }
        $test2 = "zut";
        var_dump($test2);
        return header('HTTP/1.0 404 Not Found');
    }
}
