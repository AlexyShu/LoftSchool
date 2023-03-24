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
            $this->controller->{$this->actionName}();
        } catch (RedirectException $e) {
            header('Location: ' . $e->getUrl());
            die;
        }

    }

    private function initContorller(): void
    {
        $controllerName = $this->route->getControllerName();
        if(!class_exists($controllerName)) {
            throw new \Exception('Can not find controller ' . $this->controller );
        }

        $this->controller = new $controllerName();
    }

    private function initAction():void
    {
        $actionName = $this->route->getActionName();
        if(!method_exists($this->controller, $actionName)) {
            throw new \Exception('Action ' . $actionName . ' nit found in ' . get_class($this->controller));
        }

        $this->actionName = $actionName;
    }

    private function addRoutes():void
    {
        $this->route->addRoute('user/go', User::class, 'login');
    }

}