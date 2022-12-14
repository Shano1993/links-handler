<?php

namespace App\Routing;

use App\Controller\ErrorController;
use App\Controller\LinksController;

class LinksRouter extends AbstractRouter
{
    public static function route(?string $action = null)
    {
        $controller = new LinksController();
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'add-links':
                $controller->addLinks('links/');
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}
