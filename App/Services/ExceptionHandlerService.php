<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:56
 */

namespace App\Services;


use App\Core\View;
use App\Exceptions\AccessDeniedException;
use App\Exceptions\NoFindPageException;

class ExceptionHandlerService
{

    const CODE_PAGE_NOT_FOUND = 404;
    const CODE_PAGE_NOT_ACCESS = 403;

    static function handle(\Exception $exception) {
        // TODO
        if ($exception instanceof NoFindPageException) {
            self::showError("Страница не найдена", self::CODE_PAGE_NOT_FOUND);
        }
        if ($exception instanceof AccessDeniedException) {
            self::showError("Нет доступа", self::CODE_PAGE_NOT_ACCESS);
        }
        self::showError("Ошибка сервера");
    }

    static function showError(string $error, int $code = 500) {
        http_response_code($code);
        View::render('error', ['error'=>$error]);
        die();
    }

}
