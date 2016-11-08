<?php

namespace VX\Core;

class Config
{
    private static $config = array();
    private function __clone()
    {
    }

    private function __construct()
    {
    }


    public static function get($key, $default = array(), $force = false)
    {
        if (!$force && isset(self::$config[$key])) {
            return self::$config[$key];
        }

        if (!is_file($path = DR . "/../config/{$key}.php")) {
            self::$config[$key] = $default;
            return $default;
        }

        $config = include($path);

        if(!is_array($config)){
            $config = $default;
        }

        self::$config[$key] = $config;
        return $config;
    }

    public static function set($key, $val)
    {
        self::$config[$key] = $val;
    }

    public static function getConfig()
    {
        return self::$config;
    }
}