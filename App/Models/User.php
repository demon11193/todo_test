<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 20:15
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $email
 * @property string $login
 * @property string $name
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class User extends Model
{

    const PASSWORD_SOUL = 'adfsdfasDSfs35';

    static function hashPassword(string $pass) {
        return sha1(self::PASSWORD_SOUL . $pass);
    }

}