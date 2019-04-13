<?php
require_once(COREPATH . 'Database.class.php');      // Database

require_once(COREPATH . 'utils/Input.php');

class EP_Controller{
    protected $db;

    // uitls
    protected $input;
    protected $back;

    public function __construct(){
        $this->db = EP_Database::_construct();

        $this->input = new EP_Util_Input();
    }

}