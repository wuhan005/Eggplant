<?php
require_once(COREPATH . 'Database.class.php');      // Database

require_once(COREPATH . 'utils/Input.php');
require_once(COREPATH . 'utils/Check.php');

class EP_Controller{
    protected $db;

    // uitls
    protected $input;
    protected $check;

    public function __construct(){
        $this->db = EP_Database::_construct();

        $this->input = new EP_Util_Input();
        $this->check = new EP_Util_Check();
    }

}