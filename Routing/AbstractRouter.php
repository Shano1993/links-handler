<?php

namespace App\Routing;

use App\Controller\AbstractController;
use App\Controller\ErrorController;

abstract class AbstractRouter
{
    abstract public static function route(?string $action = null);

    /**
     * @param string|null $param
     * @return string|null
     */
    public static function secured(?string $param): ?string
    {
        if (null === $param) {
            return null;
        }
        $param = strip_tags($param);
        $param = trim($param);
        return strtolower($param);
    }

    /**
     * @param AbstractController $controller
     * @param string $method
     * @param array $params
     */
    public static function routeWithParams(AbstractController $controller, string $method, array $params): void
    {
        $args = [];
        foreach ($params as $param => $type) {
            if (!isset($_GET[$param])) {
                (new ErrorController())->missingParameters();
                return;
            }
            $arg = self::secured($_GET[$param]);
            settype($arg, $type);
            $args[] = $arg;
        }
        $controller->$method(...$args);
    }
}
