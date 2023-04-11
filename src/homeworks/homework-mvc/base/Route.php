<?php

namespace Base;

class Route
{
    private $routes;
    private $controller;
    private $action;

    public function add(string $route, $controllerName, $actionName = 'index')
    {
        $this->routes[$route] = [$controllerName, $actionName];
    }

    public function auto($uri)
    {
        $parts = explode('/', $uri);
        if (empty($parts[1])) {
            return false;
        }
        $controllerName = $parts[1];
        $actionName = 'index';
        if (isset($parts[2])) {
            $actionName = $parts[2];
        }
        $controllerClassName = 'App\\Controller\\' . ucfirst(strtolower($controllerName));
        if (!class_exists($controllerClassName)) {
            return false;
        }

        $this->controller = new $controllerClassName();
        if (!method_exists($this->controller, $actionName)) {
            return false;
        }

        $this->action = $actionName;
        return true;
    }

    /**
     * @param string $uri
     * @throws Error404Exception
     */
    public function dispatch(string $uri)
    {
        $parsed = parse_url($uri);
        $uri = $parsed['path'];
        if (isset($this->routes[$uri])) {
            $this->controller = new $this->routes[$uri][0];
            $this->action = $this->routes[$uri][1];
            return;
        }

        if (!$this->auto($uri)) {
            throw new Error404Exception();
        }
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
}

//class Route
//{
//    private $controllerName;
//    private $actionName;
//    private $processed = false;
//    private $routes;
//
//    private function process()
//    {
//        if (!$this->processed) {
//            $parts = parse_url($_SERVER['REQUEST_URI']);
//            $path = $parts['path'];
//            if (($route = $this->routes[$path] ?? null) !== null) {
//                $this->controllerName = $route[0];
//                $this->actionName = $route[1];
//            } else {
//                $parts = explode('/', $path);
//                $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($parts[1]));
//                $this->actionName = strtolower($parts[2] ?? 'Index');
//            }
//
//            $this->processed = true;
//        }
//    }
//
//    public function addRoute($path, $controllerName, $actionName)
//    {
//        $this->routes[$path] = [
//            $controllerName,
//            $actionName
//        ];
//    }
//
//    public function getControllerName(): string
//    {
//        if (!$this->processed) {
//            $this->process();
//        }
//        return $this->controllerName;
//    }
//
//    public function getActionName(): string
//    {
//        if (!$this->processed) {
//            $this->process();
//        }
//        return $this->actionName . 'Action';
//    }
//}