<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Validation\Validator;

class UserController extends Controller
{
    public function login()
    {
        return $this->view('authentication.login');
    }

    public function loginPost()
    {
        $valitator = new Validator($_POST);
        $errors = $valitator->validate([
            'username'=> ['required', 'min:3'],
            'password'=> ['required']
        ]);
        //var_dump($errors); die();
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /monblog/login');
            exit;
        }
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
