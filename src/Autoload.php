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
        if (0 === strpos($class, 'Twig')) {
            $file = DR . '/../../../twig/twig/lib/'.str_replace(array('_', "\0"), array('/', ''), $class).'.php';
        } elseif (0 === strpos($class, 'bundle')) {
            $file = DR . '/../private/' . strtr($class, '\\', '/') . '.php';
        } else {
            $file = strtr(__DIR__ . str_replace(__NAMESPACE__, "", $class), '\\', '/') . '.php';
        }
        
        if (is_file($file))
            require_once($file);
    }
}


