<?php
namespace EP;

require_once(COREPATH . 'Database.class.php');      // Database
require_once(COREPATH . 'Utils.class.php');         // Utils
require_once(APPPATH . 'Utils.php');                // Utils config

class Controller{
    protected $db;

    protected $utils;

    public function __construct(){
        $this->db = Database::_construct();
        $this->utils = new Utils();
    }

}