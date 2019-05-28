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
 * Class Task
 * @package App\Models
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Task extends Model
{

    protected $fillable = ['content', 'is_finished', 'username', 'email'];

}