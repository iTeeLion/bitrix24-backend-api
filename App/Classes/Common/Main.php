<?php

namespace App\Classes\Common;

class Main
{

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    public function pre($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    // ---

    private function __clone()
    {
    }

}