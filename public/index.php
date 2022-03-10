<?php

/*
"Router\\": "routes/",
"App\\": "app/",
"Database\\": "database"
*/

use Router\Router;

// initialisation de l'autoload avec composer
require '../vendor/autoload.php';

// initialisation de constante pour les chemins
// nom de la constante, je retourne un cran en arrière avec dirname()
// DIRECTORY_SEPARATOR permet de convertir le séparateur en fonction de l'os
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
// création d'une nouvelle instance de Router
$router = new Router($_GET['url']);

// BlogController & index / le controller et la méthode dans
$router->getRoute('/posts/:id', 'App\Controllers\BlogController&show');
$router->getRoute('/posts', 'App\Controllers\BlogController&index');
$router->getRoute('/', 'App\Controllers\BlogController&welcome');

$router->run();