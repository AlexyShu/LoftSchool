<?php

namespace App\Controller;

use Base\AbstractController;
use App\Model\User as UserModel;

class User extends AbstractController
{
    public function loginAction()
    {
        $name = trim($_POST['name']);

        if ($name) {
            $password = $_POST['password'];
            $user = UserModel::getByName($name);
            if (!$user) {
                $this->view->assign('error', 'Неверный логин и пароль');
            }

            if ($user) {
                if ($user->getPassword() != UserModel::getPasswordHash($password)) {
                    $this->view->assign('error', 'Неверный логин и пароль');
                } else {
                    $_SESSION['id'] = $user->getId();
                    $this->redirect('/blog/index');
                }
            }
        }

        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }

    public function registerAction()
    {
        $name = trim($_POST['name']);
        $gender = UserModel::GENDER_MALE;
        $password = trim($_POST['password']);

        $success = true;
        if (isset($_POST['name'])) {

            if (!$name) {
                $this->view->assign('error', 'Имя не может быть пустым');
                $success = false;
            }

            if (!$password) {
                $this->view->assign('error', 'Пароль не может быть пустым');
                $success = false;
            }

            $user = UserModel::getByName($name);
            if ($user) {
                $this->view->assign('error', 'Пользователь с таким именем уже существует');
                $success = false;
            }

            if ($success) {
                $user = (new UserModel())
                    ->setName($name)
                    ->setGender($gender)
                    ->setPassword(UserModel::getPasswordHash($password));

                $user->save();

                $_SESSION['id'] = $user->getId();
                $this->setUser($user);

                $this->redirect('/blog/index');
            }
        }

        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }

    public function profileAction()
    {
        return $this->view->render('User/profile.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);

    }

    public function logoutAction()
    {
        session_destroy();

        $this->redirect('/user/login');

    }
}


//class User extends AbstractController
//{
//    protected $user;
//
//    public function __construct()
//    {
//        $this->user = new UserModel();
//    }
//    function loginAction():string
//    {
//        if($_POST['password'] !== $_POST['password_2']) {
//            return $this->view->render('/User/register.phtml', ['error' => 'Пароли не совпадают']);
//        } else {
//            $name = trim($_POST['name']);
//            $email = trim($_POST['email']);
//            $password = $this->user->getPasswordHash($_POST['password']);;
//            $this->user->createUser($name, $email, $password);
//            return $this->view->render('/User/login.phtml');
//        }
//    }
//
//    function registerAction(): string
//    {
//       return $this->view->render('/User/register.phtml', ['error' => '']);
//    }
//}