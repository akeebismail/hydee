<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 5/20/18
 * Time: 6:52 PM
 */
namespace App\Core;
use App\Config\Input;
use App\Config\Redirect;
use App\Controllers\IndexController;

class Application
{
    private $_controller;
    private $_action;
    private $_params;
    public function __construct()
    {
        $this->splitUrl();
        if (!$this->_controller){
            $index = new IndexController();
            $index->index();
            echo $this->_controller;
            echo HIS_APP.'Controllers/'.ucfirst($this->_controller).'Controllers.php';
        }elseif (file_exists(HIS_APP.'Controllers/'.ucfirst($this->_controller).'Controller.php')){
            $controller = "\\App\\Controllers\\".ucfirst($this->_controller)."Controller";

            $this->_controller = new $controller();
            if (method_exists($this->_controller, $this->_action)){
                if (!empty($this->_params)){
                    call_user_func_array(array($this->_controller, $this->_action), $this->_params);
                }else{
                    $this->_controller->{$this->_action}();
                }
            }else{
                if (strlen($this->_action) == 0){
                    $this->_controller->index();
                }else{
                    Redirect::to('problem');
                }
            }
        }
    }

    private function splitUrl(){
        if (Input::exists('url')){
            echo $_GET['url'];
            $url = trim(Input::get('url'),'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            $this->_controller = isset($url[0]) ? $url[0] : null;
            $this->_action = isset($url[1]) ? $url[1] : null;
            unset($url[0],$url[1]);
            $this->_params = array_values($url);
        }
    }

}