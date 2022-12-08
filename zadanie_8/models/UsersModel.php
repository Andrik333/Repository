<?php

namespace models;

use src\BaseModel;

class UsersModel extends BaseModel
{
    public $id;
    public $last_name;
    public $name;
    public $phone;
    public $login;
    public $password;
    public $age;

    public static function TableName()
    {
        return 'users';
    }

    public function getUser()
    {
        if($this->is_aut()) {
            session_start();
            $id = $_SESSION[$_COOKIE['PHPSESSID']];
            session_write_close();
            return self::find()->where(['id' => $id])->getOne();
        } else {
            return null;
        }
    }

    public function is_aut() : bool
    {
        session_start();
        $check = isset($_SESSION[$_COOKIE['PHPSESSID']]);
        session_write_close();
        
        return $check;
    }

    public function validPassword($password) : bool
    {
        return password_verify($password, $this->password);
    }

    public function login()
    {
        session_start();
        $_SESSION[$_COOKIE['PHPSESSID']] = $this->id;
        session_write_close();
    }

    public function logout()
    {
        session_start();
        unset($_SESSION[$_COOKIE['PHPSESSID']]);
        session_write_close();
    }
}