<?php
namespace EP;

define('COREPATH', dirname(__FILE__) . '/');
define('APPPATH', dirname(dirname(__FILE__)) . '/app/');
define('UTILSPATH', dirname(dirname(__FILE__)) . '/utils/');

define('EP_VERSION', '0.0.1');
define('EP_FOOTER', 'Eggplant - A tiny PHP API framework.');

require_once(APPPATH . 'Config.php');               // App config

require_once(COREPATH . 'Controller.class.php');    // Controller
require_once(COREPATH . 'Router.class.php');        // Router

require_once(COREPATH . 'Corrector.php');     // Corrector
require_once(COREPATH . 'Callback.class.php');      // Callback

// Core of the Eggplant.
class Eggplant{

    // Core modules
    private $router;

    public function __construct(){
        ob_start();
        $this->router = new Router();

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
                    return Callback::error(sprintf('Method "%s" not exist.', $nowFunction), 50000);
                }
            }else{
                return Callback::error(sprintf('Controller "%s" not exist.', $nowController), 50000);
            }

        }else{
            return Callback::error(sprintf('Controller file "%s.php" not exist.', $nowController), 50000);
        }
    }
}
