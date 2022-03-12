<?php

namespace App\Controllers\AdminControllers;

use App\Controllers\Controller;
use App\Models\PostModel;
use App\Models\TagModel;

class PostController extends Controller
{

    public function index()
    {
        $this->isAdmin();
        $posts = (new PostModel($this->getDB()))->allData();
        //var_dump($post);
        //var_dump($this);
        return $this->view("admin.post.index", compact('posts'));
    }
    
    public function create()
    {
        $this->isAdmin();
        $tags = (new TagModel($this->getDB()))->allData();
        return $this->view('admin.post.form', compact('tags'));
    }
    public function createPost()
    {
        $this->isAdmin();
        $post = new PostModel($this->getDB());

        $tags = array_pop($_POST);

        $result = $post->create($_POST, $tags);
        if ($result) {
            return header("Location: /monblog/admin/posts");
        }
    }
    public function delete(int $id)
    {
        $this->isAdmin();
        $post = new PostModel($this->getDB());
        $result = $post->delete($id);

        if ($result) {
            return header("Location: /monblog/admin/posts");
        }
    }
    public function edit(int $id)
    {
        $this->isAdmin();
        $post = (new PostModel($this->getDB()))->findById($id);
        $tags = (new TagModel($this->getDB()))->allData();
        return $this->view('admin.post.form', compact('post', 'tags'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $post = new PostModel($this->getDB());

        $tags = array_pop($_POST);
        //var_dump($_POST, $tags); die();

        $result = $post->update($id, $_POST, $tags);
        if ($result) {
            return header("Location: /monblog/admin/posts");
        }
    }
}
