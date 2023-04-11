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
