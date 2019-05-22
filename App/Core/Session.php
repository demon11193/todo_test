<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 22:29
 */

namespace App\Core;


class Session
{

    static function init() {
        session_start();
    }

    static function set(string $key, $value) {
        $_SESSION[$key] = $value;
    }

    static function get(string $key) {
        return $_SESSION[$key];
    }

    static function getAndRemove(string $key) {
        $error = self::get($key);
        unset($_SESSION[$key]);
        return $error;
    }

}