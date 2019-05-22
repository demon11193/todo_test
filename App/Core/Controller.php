<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:41
 */

namespace App\Core;


class Controller
{

    /**
     * Проверяет есть ли доступ у пользователя к методу
     *
     * @param Request $request
     * @param string $methodName
     * @param array $params
     * @return bool
     */
    static function hasAccess(Request $request, string $methodName, array $params):bool {
        return true;
    }

    function redirectTo(string $url) {
        header('Location: ' . $url);
        die();
    }

    function backWithError(string $message) {
        Session::set('error', $message);
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
        die();
    }

    function back() {
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
        die();
    }

}