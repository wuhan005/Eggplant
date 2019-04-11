<?php
define('COREPATH', dirname(__FILE__) . '/');
define('APPPATH', dirname(dirname(__FILE__)) . '/app/');

require_once(APPPATH . 'Config.php');               // App config

require_once(COREPATH . 'Database.class.php');      // Database
require_once(COREPATH . 'Controller.class.php');    // Controller
require_once(COREPATH . 'Router.class.php');        // Router

require_once(COREPATH . 'Callback.class.php');      // Callback

// Core of the Eggplant.
class Eggplant{

    // Core modules
    private $router;

    public function __construct(){
        $this->router = new EP_Router();

        $nowController = $this->router->GetController();
        $nowFunction = $this->router->GetFunction();

        // Check the file
        if(file_exists(APPPATH . 'controllers/' . $nowController . '.php')){
            // Load the controller
            require_once(COREPATH . 'controllers/' . $nowController . '.class.php');
            $controller = new $nowController();

            // Check the function is defined
            if(in_array($nowFunction, get_class_methods($nowController))){
                $controller->$nowFunction();
            }else{
                // Default use the index function
                if(in_array('index', get_class_methods($nowController))){
                    return $controller->index();
                }
                return EP_Callback::error('Bad router');
            }

        }else{
            // Bad router
            return EP_Callback::error('Bad router');
        }
    }
}
