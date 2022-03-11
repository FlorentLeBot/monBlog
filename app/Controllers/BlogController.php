<?php

namespace App\Controllers;

use App\Models\TagModel;
use App\Models\PostModel;

class BlogController extends Controller
{
    public function welcome()
    {
        return $this->view("blog.welcome");
    }
    public function index()
    {
        // création d'une nouvelle instance de la classe Post
        $post = new PostModel($this->getDB());
        // tous les posts
        $posts = $post->allData();
        // je crée un tableau avec la fonction compact, second paramètre de la fonction view dans mon Controller (récupération de l'id)
        return $this->view("blog.index", compact('posts'));
    }
    public function show(int $id)
    {
        $post = (new PostModel($this->getDB()))->findById($id);      
        // je crée un tableau avec la fonction compact, second paramètre de la fonction view dans mon Controller (récupération de l'id)
        return $this->view("blog.show", compact('post'));
    }
    public function tag(int $id){
        $tag = (new TagModel($this->getDB()))->findById($id);
        return $this->view('blog.tag', compact('tag'));
        
    }
}
