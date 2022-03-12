<?php

use App\Exceptions\NotFoundException;
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

// BlogController & index / le controller et la méthode 
$router->getRoute('/', 'App\Controllers\BlogController&welcome');
$router->getRoute('/posts', 'App\Controllers\BlogController&index');
$router->getRoute('/posts/:id', 'App\Controllers\BlogController&show');
$router->getRoute('/tags/:id', 'App\Controllers\BlogController&tag');

// administration

$router->getRoute('/admin/posts', 'App\Controllers\AdminControllers\PostController&index');
$router->getRoute('/admin/posts/create', 'App\Controllers\AdminControllers\PostController&create');
$router->post('/admin/posts/create', 'App\Controllers\AdminControllers\PostController&createPost');
$router->post('/admin/posts/delete/:id', 'App\Controllers\AdminControllers\PostController&delete');
$router->getRoute('/admin/posts/edit/:id', 'App\Controllers\AdminControllers\PostController&edit');
$router->post('/admin/posts/edit/:id', 'App\Controllers\AdminControllers\PostController&update');

$router->getRoute('/login', 'App\Controllers\UserController&login');
$router->post('/login', 'App\Controllers\UserController&loginPost');
$router->getRoute('/logout', 'App\Controllers\UserController&logout');

try {
    $router->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
