<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:43
 */

namespace App\Controllers;


use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller
{

    function index(Request $request) {
        if (Auth::hasAuth()) {
            $this->backWithError('Вы уже авторизованы.');
        }
        if (!$request->post('login')) {
            $this->backWithError('Укажите логин.');
        }
        if (!$request->post('password')) {
            $this->backWithError('Укажите пароль.');
        }
        $res = Auth::login($request->post('login'), $request->post('password'));
        if (!$res) {
            $this->backWithError('Неверный логин или пароль.');
        }
        $this->back();
    }

    function logout(Request $request) {
        Auth::logout();
        $this->back();
    }

}