<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 22:38
 */

namespace App\Core;


use App\Models\User;

class Auth
{

    /**
     * @param string $login
     * @param string $password
     * @return bool возвращает true в случае успеха
     */
    static function login(string $login, string $password):bool {
        $user = User::where('login', $login)->first();
        if (!$user || $user->password != User::hashPassword($password)) {
            Session::set('user_id', null);
            return false;
        }
        Session::set('user_id', $user->id);
        return true;
    }

    static function logout() {
        Session::set('user_id', null);
    }

    static function getUserId() {
        return Session::get('user_id');
    }

    static function hasAuth():bool {
        return !!Session::get('user_id');
    }

    static function user():User {
        $userId = Session::get('user_id');
        if (!$userId) {
            return null;
        }
        return User::find($userId);
    }

}