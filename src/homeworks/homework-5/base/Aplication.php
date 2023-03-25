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
            $this->addRoutes();
            $this->initContorller();
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

    private function initContorller(): void
    {
        $controllerName = $this->route->getControllerName();
        if(!class_exists($controllerName)) {
            echo('Can not find controller ' . $controllerName);
        }

        $this->controller = new $controllerName();
    }

    private function initAction():void
    {
        $actionName = $this->route->getActionName();
        if(!method_exists($this->controller, $actionName)) {
            echo('Action ' . $actionName . ' nit found in ' . get_class($this->controller));
        }

        $this->actionName = $actionName;
    }

    private function addRoutes():void
    {
        $this->route->addRoute('user/go', User::class, 'login');
    }

}