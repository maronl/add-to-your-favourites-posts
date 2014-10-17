<?php
class PLUGIN_CLASS_NAME_BASE_Model {

    private static $_instance = null;

    private function __construct() { }
    private function  __clone() { }

    public static function getInstance() {
        if( !is_object(self::$_instance) )
            self::$_instance = new PLUGIN_CLASS_NAME_BASE_Model();
        return self::$_instance;
    }

} 