<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:25
 */
namespace App\Core;

use App\Services\RouteService;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class App
{
    /**
     * @var App
     */
    private static $instance;
    /**
     * @var RouteService
     */
    private $routeService;
    /**
     * @var Request
     */
    private $request;

    public function init() {
        $this->request = new Request();
        Session::init();
        $this->initDb();
        $this->initRouteService();
    }

    function getRequest(): Request {
        return $this->request;
    }

    function getRouteService():RouteService {
        return $this->routeService;
    }

    private function initRouteService() {
        $this->routeService = new RouteService();
        require __DIR__ . '/../routes.php';
    }

    private function initDb() {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => Env::get('DB_DRIVER'),
            'host'      => Env::get('DB_HOST'),
            'database'  => Env::get('DB_DATABASE'),
            'username'  => Env::get('DB_LOGIN'),
            'password'  => Env::get('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    static function instance():App {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}