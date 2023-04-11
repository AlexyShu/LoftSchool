<?php

namespace App\Controller;

use Base\AbstractController;
use App\Model\Message;

class Blog extends AbstractController
{
    public function index()
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }
        $messages = Message::getList();
        if ($messages) {
            $userIds = array_map(function (Message $message) {
                return $message->getAuthorId();
            }, $messages);
            $users = \App\Model\User::getByIds($userIds);
            array_walk($messages, function (Message $message) use ($users) {
                if (isset($users[$message->getAuthorId()])) {
                    $message->setAuthor($users[$message->getAuthorId()]);
                }
            });
        }
        return $this->view->render('blog.phtml', [
            'messages' => $messages,
            'user' => $this->getUser()
        ]);
    }

    public function addMessage()
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }

        $text = (string) $_POST['text'];
        if (!$text) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Message([
            'text' => $text,
            'author_id' => $this->getUserId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();
        $this->redirect('/blog');

    }
}

//class Blog extends AbstractController
//{
//    function indexAction()
//    {
//        if (!$this->user) {
//            $this->redirect('/user/register');
//        }
//
//        return $this->view->render('Blog/index.phtml', [
//            'user' => $this->user
//        ]);
//    }
//}