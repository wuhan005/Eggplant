<?php
define('COREPATH', dirname(__FILE__) . '/');
define('APPPATH', dirname(dirname(__FILE__)) . '/app/');

define('EP_VERSION', '0.0.1');
define('EP_FOOTER', 'Eggplant - A tiny PHP API framework.');

require_once(APPPATH . 'Config.php');               // App config

require_once(COREPATH . 'Controller.class.php');    // Controller
require_once(COREPATH . 'Router.class.php');        // Router

require_once(COREPATH . 'Corrector.class.php');     // Corrector
require_once(COREPATH . 'Callback.class.php');      // Callback

// Core of the Eggplant.
class Eggplant{

    // Core modules
    private $router;

    public function __construct(){
        $this->router = new EP_Router();

        $nowController = $this->router->get_controller();
        $nowFunction = $this->router->get_function();

        // Check the file
        if(file_exists(APPPATH . 'controllers/' . $nowController . '.php')){
            // Load the controller
            require_once(APPPATH . 'controllers/' . $nowController . '.php');

            // Check the class is existed  or not
            if(class_exists($nowController)){
                $controller = new $nowController();

                // Check the function is existed or not
                if(method_exists($controller, $nowFunction)){
                    return $controller->$nowFunction();
                }else{
                    // TODO

                    echo('method not exist');
                }
            }else{
                // TODO
                echo('class not exist');
            }

        }else{
            // Bad router
            return EP_Callback::error('Bad router');
        }
    }
}
