<?php

namespace App\Controller;

use Base\AbstractController;
use App\Model\Blog as BlogModel;

class Blog extends AbstractController
{
    protected $blog;

    public function __construct()
    {
        $this->blog = new BlogModel();
    }

    public function blogAction():string
    {
        return $this->view->render('/Blog/blog.phtml');
    }
}