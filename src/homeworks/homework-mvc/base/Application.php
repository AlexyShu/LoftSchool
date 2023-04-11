<?php
namespace Base;

use App\Controller\User;

class Application
{
    private $route;
    private $db;

    public function __construct(Route $route)
    {
        $this->route = $route;
        $this->db = \Base\Db::getInstance();
    }

    public function run()
    {
        $this->db->createUserTable();
        $this->db->createMessagesTable();
        $view = new View();
        $view->setTemplatePath(getcwd() . '/../app/View');

        /** @var AbstractController $controller */

        try {
            $this->route->dispatch($_SERVER['REQUEST_URI']);
            $controller = $this->route->getController();
            $action = $this->route->getAction();
            $controller->setView($view);

            $session = new Session();
            $session->init();
            $controller->setSession($session);
            $controller->preDispatch();
            $result = $controller->$action();

            // ...

            echo $result;
        } catch (RedirectException $e) {
            header('Location: ' . $e->getUrl());
        } catch (Error404Exception $e) {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            echo 'Page not found';
        }
    }
}

//class Application
//{
//    private $route;
//    /** @var AbstractController */
//    private $controller;
//    private $actionName;
//    private $db;
//
//
//    public function __construct()
//    {
//        $this->route = new Route();
//        $this->db = \Base\Db::getInstance();
//    }
//
//    public function run()
//    {
//        $this->db->createUserTable();
//        $this->db->createMessagesTable();
//        try {
//            session_start();
//            $this->addRoutes();
//            $this->initController();
//            $this->initAction();
//
//            $view = new View();
//            $this->controller->setView($view);
//            $this->initUser();
//
//            $content = $this->controller->{$this->actionName}();
//
//            echo $content;
//
//        } catch (RedirectException $e) {
//            header('Location: ' . $e->getUrl());
//            die;
//        } catch (RouteException $e) {
//            header("HTTP/1.0 404 Not Found");
//            echo $e->getMessage();
//        }
//    }
//
//    private function initUser()
//    {
//        $id = $_SESSION['id'] ?? null;
//        if ($id) {
//            $user = \App\Model\user::getById($id);
//            if ($user) {
//                $this->controller->setUser($user);
//            }
//        }
//    }
//
//    private function addRoutes()
//    {
//        ///** @uses \App\Controller\user::loginAction() */
//        $this->route->addRoute('/user/go', user::class, 'login');
//        ///** @uses \App\Controller\user::registerAction() */
//        //$this->route->addRoute('/user/register', \App\Controller\user::class, 'register');
//        ///** @uses \App\Controller\Blog::indexAction() */
//        $this->route->addRoute('/blog', \App\Controller\Blog::class, 'index');
//        //$this->route->addRoute('/blog/index', \App\Controller\Blog::class, 'index');
//    }
//
//    private function initController()
//    {
//        $controllerName = $this->route->getControllerName();
//        if (!class_exists($controllerName)) {
//            echo ($controllerName);
//            throw new \Exception('Cant find controller ' . $controllerName);
//        }
//
//        $this->controller = new $controllerName();
//    }
//
//    private function initAction()
//    {
//        $actionName = $this->route->getActionName();
//        if (!method_exists($this->controller, $actionName)) {
//            throw new \Exception('Action ' . $actionName . ' not found in ' . get_class($this->controller));
//        }
//
//        $this->actionName = $actionName;
//    }
//}
