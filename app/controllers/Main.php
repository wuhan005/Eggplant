<?php

class Main extends \EP\Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        \EP\Callback::success('Hello Eggplant!', 'Success');
    }

    public function GetList(){
        \EP\Callback::success(array(2,3,3), '这是 GET 的数据');
    }
}