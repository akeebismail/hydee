<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 3:33 PM
 */
include 'constants.php';
require 'vendor/autoload.php';
use App\Core\Database;
if (Database::getDbInstance()){
    echo  'db connected';
}