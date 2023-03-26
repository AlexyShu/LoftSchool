<?php

namespace Base;

use App\Controller\User;

class Aplication
{
    private $route;
    /** @var AbstractController */
    private $controller;
    private $actionName;

    public function __construct()
    {
        $this->route = new Route();
    }

    public function run()
    {
        try {
            session_start();
            $this->addRoutes();
            $this->initController();
            $this->initAction();
            $view = new View();
            $this->controller->setView($view);
            $content = $this->controller->{$this->actionName}();

            echo($content);

        } catch (RedirectException $e) {
            header('Location: ' . $e->getUrl());
            die;
        }

    }

    private function initController(): void
    {
        $controllerName = $this->route->getControllerName();
        if(!class_exists($controllerName)) {
            echo('Can not find controller ' . $controllerName);
        }

        $this->controller = new $controllerName();
    }

    private function initUser() {
        $id = $_SESSION['id'] ?? null;
        if($id) {
            $userModel = new \App\Model\User();
            $user = $userModel->getUserById($id);
            if($user) {
                $this->controller->setUser($user);
            }
        }
        $this->controller->setUser();
    }

    private function initAction():void
    {
        $actionName = $this->route->getActionName();
        if(!method_exists($this->controller, $actionName)) {
            echo('Action ' . $actionName . ' not found in ' . get_class($this->controller));
        }

        $this->actionName = $actionName;
    }

    private function addRoutes()
    {
        $this->route->addRoute('/blog', \App\Controller\Blog::class, 'blog');
    }

}