<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 20:18
 */

namespace App\Core;


class Env
{

    private static $data = null;

    private static function init() {
        self::$data = [];

        $handle = fopen(__DIR__ . '/../../.env', "r");
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }
            if (strpos('#', $line) === 0) {
                continue;
            }
            $key = substr($line, 0, strpos($line, '='));
            $value = substr($line, strpos($line, '=') + 1);
            self::$data[$key] = $value;
        }
        fclose($handle);
    }

    static function get(string $key) {
        if (is_null(self::$data)) {
            self::init();
        }
        return self::$data[$key] ?? null;
    }

}