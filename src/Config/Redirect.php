<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 6:57 PM
 */
namespace App\Config;
class Redirect {

    public static function to($location){

        return header('Location: '. $location);
    }
}