<?php

class EP_Router{
    private $urlSegment;
    private $nowController;
    private $nowFunc;

    public function __construct(){
        // URL Router
        // Get the function
        $this->urlSegment = @explode('/', $_SERVER['PATH_INFO']);
        $length = count($this->urlSegment);


//        $nowController = @$this->urlSegment[2];
//        $nowFunc = @$this->urlSegment[3];
//
//        if($nowController == null){
//            //If it is /index.php
//            $nowController = 'Main';
//        }
//
//        // Check the router
//        if(file_exists(COREPATH . 'controllers/' . $nowController . '.class.php')){
//            // Load the controller
//            require_once(COREPATH . 'controllers/' . $nowController . '.class.php');
//            $controller = new $nowController;
//
//            // Check the function is defined
//            if(in_array($nowFunc, get_class_methods($nowController))){
//                $controller->$nowFunc();
//            }else{
//                // Default use the index function
//                if(in_array('index', get_class_methods($nowController))){
//                    return $controller->index();
//                }
//
//                return EP_Callback::error('Bad router');
//            }
//
//        }else{
//            // Bad router
//            return EP_Callback::error('Bad router');
//        }
    }

    public function GetController(){

    }

    public function GetFunction(){

    }
}