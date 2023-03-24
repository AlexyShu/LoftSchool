<?php

namespace App\Controller;

use Base\AbstractController;

class User extends AbstractController
{
    function loginAction()
    {
        echo("Login action");
    }

    function registerAction()
    {
        echo("Register action");
    }
}