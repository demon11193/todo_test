<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:41
 */

namespace App\Core;


use mysql_xdevapi\Exception;
use Rakit\Validation\Validator;

class Controller
{

    function validate(array $inputs, array $rules, array $messages = null) {
        $validator = new Validator();
        $validation = $validator->validate($inputs, $rules, $messages);
        if ($validation->fails()) {
            $this->backWithError(
                implode($validation->errors()->firstOfAll(), "\n")
            );
        }
    }

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