<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 3:02 PM
 */
namespace App\Core;
use PDO;
use PDOException;
use App\Config\Config;
class Database{

    private static  $_db;
    private $_pdo,$_query,$_error =false,$_results,$_count;
    private function __construct()
    {
        try{
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),
                Config::get('mysql/user'),Config::get('mysql/pass'));
        }catch (PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getDbInstance (){
        if (!isset(self::$_db)){
            self::$_db = new Database();
        }

        return self::$_db;
    }
}