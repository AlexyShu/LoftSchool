<?php

namespace App\Controller;

use Base\AbstractController;
use App\Model\User as UserModel;

class User extends AbstractController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }
    function loginAction():string
    {
        if($_POST['password'] !== $_POST['password_2']) {
            return $this->view->render('/User/register.phtml', ['error' => 'Пароли не совпадают']);
        } else {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $this->user->getPasswordHash($_POST['password']);;
            $this->user->createUser($name, $email, $password);
            return $this->view->render('/User/login.phtml');
        }
    }

    function registerAction(): string
    {
       return $this->view->render('/User/register.phtml', ['error' => '']);
    }
}