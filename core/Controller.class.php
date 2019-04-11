<?php

require_once(COREPATH . 'utils/Input.php');

class EP_Controller{
    protected $db;

    // uitls
    protected $input;

    public function __construct(){
//        $this->db = Database::_construct();

        $this->input = new EP_Util_Input();
    }

}