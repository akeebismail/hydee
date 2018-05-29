<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 1:12 PM
 */
namespace App\Controllers;

class CartController{

    public function index(){
        echo  'cart index';
    }
    public function show($id){
        echo  'cart show'.$id;
    }
}