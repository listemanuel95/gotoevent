<?php

namespace dao;

abstract class SingletonDAO
{
    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}

    public static function get_instance()
    {
        $cls = get_called_class();

        if (!isset(self::$instances[$cls]))
            self::$instances[$cls] = new static;
            
        return self::$instances[$cls];
    }
}

?>