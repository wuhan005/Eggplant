<?php

class Main extends EP_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        EP_Callback::success('Hello Eggplant!', 'Success');
    }

    public function GetList(){
        EP_Callback::success(array(2,3,3), '这是 GET 的数据');
    }
}