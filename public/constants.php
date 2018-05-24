<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 3:32 PM
 */

$GLOBALS['config'] = [
    'mysql' => [
        'host'=>'localhost',
        'user'=>'root',
        'pass'=>'akeebdeen',
        'db'=>'hydee_task'
    ],
];

define('APP_PUBLIC', 'public');
define('APP_ROOT',dirname(__DIR__).DIRECTORY_SEPARATOR);
define('APP_Protocol','//');
define('name',$_SERVER['HTTP_CONNECTION']);
define('URL_DOMAIN',$_SERVER['HTTP_HOST']);

define('APP_Subfolder',str_replace(APP_PUBLIC,'',dirname($_SERVER['SCRIPT_NAME'])));
define('APP_URL',APP_Protocol.URL_DOMAIN.APP_Subfolder);

define('HIS_APP',APP_ROOT.'src'.DIRECTORY_SEPARATOR);