<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 6:56 PM
 */

namespace App\Config;

class Input{

    public static function get($item){
        if (isset($_POST[$item])){
            return $_POST[$item];
        }elseif (isset($_GET[$item])){
            return $_GET[$item];
        }

        return '';
    }

    public  static  function exists($type = 'post'){
        switch ($type){
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }

    }

    public function post(){
        
    }
}