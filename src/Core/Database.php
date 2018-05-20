<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 3:02 PM
 *this handles all the request to / from the database
 *  select ,insert, update and delete
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

    /**
     * get the db instance
     * to avoid multiple db instances
     * @return Database
     */
    public static function getDbInstance (){
        if (!isset(self::$_db)){
            self::$_db = new Database();
        }

        return self::$_db;
    }

    /**
     * binds sql with values
     * sql = 'SELECT FROM table WHERE student_id = ? AND part = ?
     * value = ['id' => 2, 'id' =>4];
     * @param $sql
     * @param array $value
     * @return Database
     */
    public function query($sql, $value =[]){
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)){
            $xx = 1;
            if (count($value)){
                foreach ($value as $key => $param){
                    $this->_query->bindValue(":$key",$param);
                    $xx++;
                }
            }
            if ($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;
    }

    /**
     * @param $action = select,delete
     * @param $table
     * @param array $where column and value
     * @return Database|bool
     */
    public function action($action, $table, $where = []){
        $sql = "{$action} FROM {$table} WHERE ";
        $xx = 1;
        foreach ($where as $key=> $value) {
            $sql .= "$key = :$key";
            if ($xx < count($where)){
                $sql .= "AND ";
            }
            $xx++;
        }
        if (!$this->query($sql, $where)){
            return $this;
        }
        return false;
    }

    /**
     * @method insert();
    insert into the table specified,
     * bind the fields with value using the array key value pair
     * @param $table ,the table to insert into
     * @param array $field , column as key and value as value
     * e.g ['first_name'=>'Akeeb', 'last_name'=>'Ismail'];
     * @return bool
     */
    public function insert($table, $field = []){
        $keys = array_keys($field);
        $values = null;
        $xx = 1;
        foreach ($field as $key => $item){
            $values .= ":$key";
            if ($xx < count($field)){
                $values .= ", ";
            }
            $xx++;
        }
        $sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";
        if (!$this->query($sql, $field)->error()){
            return true;
        }
        return false;
    }

    public function select(){

    }

    public function get(){

    }

    /**
     * Db error
     * @return bool
     */
    public function error(){
        return $this->_error;
    }

    /**
     * Db fetch results
     * @return mixed
     */
    public function results(){
        return $this->_results;
    }

    /**
     * get the first result of any query
     * @return mixed
     */
    public function first(){
        return $this->_results[0];
    }

    /**
     * the number of rows fetch
     * @return mixed
     */
    public function count(){
        return $this->_count;
    }

    /**
     * perform raw sql query
     * @param $sql
     * @return Database
     */
    public function sql($sql){
        $this->_query = $this->_pdo->prepare($sql);
        if ($this->_query->execute()) {
            $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
            $this->_count = $this->_query->rowCount();
        }else{
            $this->_error = true;
        }

        return $this;
    }
}