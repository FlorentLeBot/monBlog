<?php

namespace App\Models;


class UserModel extends Model
{
    protected $table = "users";

    public function getByUserName(string $username): UserModel
    {
        //return $this->query("SELECT `id`, `username`, `password`, `admin` FROM {$this->table} WHERE username = ?", [$username], true);
        return $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
    }
}
