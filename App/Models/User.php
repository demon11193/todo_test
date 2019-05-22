<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 20:15
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    const PASSWORD_SOUL = 'adfsdfasDSfs35';

    static function hashPassword(string $pass) {
        return sha1(self::PASSWORD_SOUL . $pass);
    }

}