<?php

namespace App\Routing;

use App\Controller\ErrorController;
use App\Controller\UserController;

class UserRouter extends AbstractRouter
{
    /**
     * @param string|null $action
     * @return void
     */
    public static function route(?string $action = null)
    {
        $controller = new UserController();
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'register':
                $controller->register();
                break;
            case 'login':
                $controller->login();
                break;
            case 'logout':
                $controller->logout();
                break;
            case 'profile':
                $controller->profile();
                break;
            case 'delete-account':
                self::routeWithParams($controller, 'deleteAccount', ['id' => 'int']);
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}
