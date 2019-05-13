<?php

class Main extends \EP\Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $name = $this->utils->Input->get('name');
        \EP\Callback::success(sprintf('Hello %s!', $name), 'Success');
    }

    public function GetList(){
        \EP\Callback::success(array(2,3,3), '这是 GET 的数据');
    }
}