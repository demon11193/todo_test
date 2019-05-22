<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:31
 */

namespace App\Services;


use App\Core\Request;
use App\Core\Route;

class RouteService
{

    /**
     * @var Route[]
     */
    private $routes = [];

    /**
     * @param string $pattern маска пути
     * @param string $requestMethods поддерживаемые типы запросов, через запятую
     * @param string $controllerMethod метод контролера
     */
    function registerRoute(string $pattern, string $requestMethods, string $controllerMethod) {
        $this->routes[] = new Route($pattern, $requestMethods, $controllerMethod);
    }

    /**
     * @param Request $request
     * @return Route|null
     */
    function getCurrentRoute(Request $request) {
        foreach ($this->routes as $route) {
            if ($route->confirm($request)) {
                return $route;
            }
        }
        return null;
    }

}