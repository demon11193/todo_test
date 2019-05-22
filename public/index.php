<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:20
 */
use App\Exceptions\AccessDeniedException;
use App\Exceptions\NoFindPageException;
use App\Services\ExceptionHandlerService;
use App\Core\App;

function dd($value) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}
error_reporting(E_ERROR ^ E_PARSE);
require '../vendor/autoload.php';
spl_autoload_register(function ($className) {
    include __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';
});

$app = App::instance();
$app->init();
try {
    $route = $app->getRouteService()
        ->getCurrentRoute($app->getRequest());
    if (!$route) {
        throw new NoFindPageException();
    }
    if (!$route->hasAccess($app->getRequest())) {
        throw new AccessDeniedException();
    }
    $route->run($app->getRequest());
}
catch (Exception $exception) {
    ExceptionHandlerService::handle($exception);
}
