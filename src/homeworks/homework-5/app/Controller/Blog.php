<?php

namespace App\Controller;

use Base\AbstractController;
use App\Model\Blog as BlogModel;
use App\Model\User as UserModel;

class Blog extends AbstractController
{
    protected $blog;
    protected $user;


    public function __construct()
    {
        $this->blog = new BlogModel();
        $this->user = new UserModel();
    }

    public function blogAction():string
    {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $userProfile = $this->user->getUser($email, $password);
        $_SESSION['id'] = $userProfile[0]['id'];
        $messages = $this->blog->getLatestTwentyMessages();
        echo('Блог:') . '<br>';
        if(empty($messages)) {
            echo('Сообщений пока нет') . '<br>';
        } else {
            foreach ($messages as $message) {
                $userName = $this->user->getUserById($message['user_id']);
                echo (' (пользователь: ' . $userName[0]['name']) . ')' . '<br>';
            }
        }

        return $this->view->render('/Blog/blog.phtml');
    }

    public function successAction():string
    {
        $this->blog->createBlog($_POST['text']);
        return $this->view->render('/Blog/success.phtml');
    }
}