<?php

use EP\Callback;
use EP\Controller;

class Main extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $name = $this->utils->Input->get('name');
        Callback::success(sprintf('Hello %s!', $name), 'Success');
    }

    public function GetList(){
        Callback::success(array(2,3,3), '这是 GET 的数据');
    }
}