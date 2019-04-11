<?php
define('COREPATH', dirname(__FILE__) . '/');
define('APPPATH', dirname(dirname(__FILE__)) . '/app/');

require_once(APPPATH . 'Config.php');               // App config

require_once(COREPATH . 'Config.class.php');        // Load Config
require_once(COREPATH . 'Database.class.php');      // Database
require_once(COREPATH . 'Controller.class.php');    // Controller
require_once(COREPATH . 'Router.class.php');        // Router

require_once(COREPATH . 'Callback.class.php');      // Callback

// Core of the Eggplant.
class Eggplant{

    // Core modules
    private $config;

    public function __construct(){
        $this->config = new EP_Config();
    }
}
