<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends Controller
{
    public function login()
    {
        return $this->view('authentication.login');
    }

    public function loginPost()
    {
        $user = (new UserModel($this->getDB()))->getByUsername($_POST['username']);
        //var_dump($user);
        if (password_verify($_POST['password'], $user->password)) {
            //var_dump($user->admin); die();
            $_SESSION['authentication'] = (int) $user->admin;
            return header('Location: /monblog/admin/posts?sucess=true');
        } else {
            return header('Location: /monblog/login');
        }
    }
    public function logout(){
        session_destroy();
        return header('Location: /monblog/');
    }
}
