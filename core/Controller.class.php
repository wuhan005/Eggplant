<?php
namespace EP;

require_once(COREPATH . 'Database.class.php');      // Database

require_once(UTILSPATH . 'EP_Input.php');
require_once(UTILSPATH . 'EP_Check.php');

class Controller{
    protected $db;

    // uitls
    protected $input;
    protected $check;

    public function __construct(){
        $this->db = Database::_construct();

        $this->input = new \EP\Utils\X\Input();
        $this->check = new \EP\Utils\X\Check();
    }

}