<?php

namespace App\Controllers\AdminControllers;

use App\Controllers\Controller;
use App\Models\PostModel;

class PostController extends Controller
{

    public function index()
    {
        $posts = (new PostModel($this->getDB()))->allData();
        //var_dump($post);
        //var_dump($this);
        return $this->view("admin.post.index", compact('posts'));
    }
    public function delete(int $id)
    {
        $post = new PostModel($this->getDB());
        $result = $post->delete($id);

        if ($result) {
            return header("Location: /monblog/admin/posts");
        }
    }
    public function edit(int $id)
    {
        $post = (new PostModel($this->getDB()))->findById($id);
        return $this->view('admin.post.edit', compact('post'));
    }

    public function update(int $id)
    {
        $post = new PostModel($this->getDB());
        $result = $post->update($id, $_POST);
        if ($result) {
            return header("Location: /monblog/admin/posts");
        }
    }
}
