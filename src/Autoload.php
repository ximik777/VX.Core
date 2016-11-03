<?php

namespace VX\Core;

class Autoload
{
    public static function Register($prepend = false)
    {
        if (PHP_VERSION_ID < 50300) {
            spl_autoload_register(array(__CLASS__, 'Autoload'));
        } else {
            spl_autoload_register(array(__CLASS__, 'Autoload'), true, $prepend);
        }
    }

    public static function Autoload($class)
    {
        $file = strtr(__DIR__ . str_replace(__NAMESPACE__, "", $class), '\\', '/') . '.php';

        if (is_file($file))
            require_once($file);
    }
}


