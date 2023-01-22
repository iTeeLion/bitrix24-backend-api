<?php

namespace App\Classes\Common;

use Illuminate\Config\Repository;

class Config
{

    private static $config = null;

    public static function getInstance()
    {
        if (self::$config === null) {
            $path = realpath(__DIR__ . '/../../../config.php');
            self::$config = new Repository(require $path);
        }

        return self::$config;
    }

    private function __construct()
    {
    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    private function __clone()
    {
    }

}