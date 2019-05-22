<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:25
 */
$app = \App\Core\App::instance();
$routeService = $app->getRouteService();

$routeService->registerRoute('', 'GET', 'TaskListController@index');
$routeService->registerRoute('tasks', 'GET', 'TaskListController@show');
$routeService->registerRoute('tasks', 'POST', 'TaskListController@edit');
$routeService->registerRoute('tasks/{id}', 'GET', 'TaskListController@show');
$routeService->registerRoute('tasks/{id}', 'POST', 'TaskListController@edit');

$routeService->registerRoute('auth', 'POST', 'AuthController@index');
$routeService->registerRoute('logout', 'GET', 'AuthController@logout');