<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 3:07 PM
 */
namespace App\Config;

class Config {
    public static function get($path = null){
        if ($path){
            $config = $GLOBALS['config'];
            $paths = explode('/', $path);
            foreach ($paths as $item){
                if (isset($config[$item])){
                    $config = $config[$item];
                }
            }
            return $config;
        }
        return false;
    }
}