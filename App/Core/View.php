<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 19:56
 */

namespace App\Core;


use Philo\Blade\Blade;

class View
{
    static function render(string $file, array $data = []) {
        $views = __DIR__ . '/../../views';
        $cache = __DIR__ . '/../../cache';

        $blade = new Blade($views, $cache);
        echo $blade->view()
            ->make($file, $data)
            ->render();
    }
}