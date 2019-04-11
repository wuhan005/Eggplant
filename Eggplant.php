<?php
define('COREPATH', dirname(__FILE__) . '/');

require_once(COREPATH . 'Config.class.php');        // Basic config
require_once(COREPATH . 'Callback.class.php');      // Callback JSON
require_once(COREPATH . 'Controller.class.php');    // Controller

// Core of the Eggplant.
class Eggplant{

    public function __construct(){
        // URL Router
        // Get the function
        $urlPathInfo = @explode('/', $_SERVER['PATH_INFO']);
        $nowController = @$urlPathInfo[1];
        $nowFunc = @$urlPathInfo[2];


        if($nowController == null){
            //If it is /index.php
            $nowController = 'Main';
        }

        // Check the router
        if(file_exists(COREPATH . 'controllers/' . $nowController . '.class.php')){
            // Load the controller
            require_once(COREPATH . 'controllers/' . $nowController . '.class.php');
            $controller = new $nowController;

            // Check the function is defined
            if(in_array($nowFunc, get_class_methods($nowController))){
                $controller->$nowFunc();
            }else{
                // Default use the index function
                if(in_array('index', get_class_methods($nowController))){
                    return $controller->index();
                }

                return Callback::error('Bad router');
            }

        }else{
            // Bad router
            return Callback::error('Bad router');
        }
    }


}
