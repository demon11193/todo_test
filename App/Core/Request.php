<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:42
 */

namespace App\Core;


class Request
{

    function uri():string {
        return $_SERVER['REQUEST_URI'];
    }

    function post(string $key) {
        return $_POST[$key] ?? null;
    }

    function get(string $key) {
        return $_GET[$key] ?? null;
    }

    function method():string {
        return $_SERVER['REQUEST_METHOD'];
    }

}