<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 20:15
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = ['content', 'is_finished', 'user_id'];

    function user() {
        return $this->belongsTo(User::class);
    }

}