<?php

namespace App\Controllers\AdminControllers;

use App\Controllers\Controller;
use App\Models\PostModel;

class PostController extends Controller{
    // création d'une nouvelle instance de post
    public function index(){
        $posts = (new PostModel($this->getDB()))->allData();
        //var_dump($post);
        //var_dump($this);
        return $this->view("admin.post.index", compact('posts'));
       
    }
}