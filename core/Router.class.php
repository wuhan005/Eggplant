<?php

class EP_Router{
    private $router;

    private $urlSegment;
    private $nowController;
    private $nowFunction = 'index';     // Set default method

    public function __construct(){

        // Check the router.php file
        $filePath = APPPATH . 'Router.php';
        if(file_exists($filePath)){
            // Load the user's router
            require($filePath);
            $this->router = $router;
        }else{
            Corrector::Show(101, 'app/Router.php');
        }

        // URL Router
        $this->urlSegment = @explode('/', trim($_SERVER['PATH_INFO'], '/'));
        if(!$this->handle_router()){
            // Turn to error router
            // TODO
        }
    }

    private function handle_router(){
        $length = count($this->urlSegment);

        // Just one segment
        if($length === 1){
            // Check if in the router first
            if(key_exists($this->urlSegment[0], $this->router)){
                $routerValue = $this->router[$this->urlSegment[0]];
                // Check the router value

                // Empty, error
                if($routerValue === ''){
                    return false;
                }

                $routerValue = explode('/', trim($routerValue, '/'));
                $this->nowController = $routerValue[0];
                if(isset($routerValue[1])){
                    $this->nowFunction = $routerValue[1];
                }else{
                    $this->nowFunction = 'index';
                }
                return true;

            }else{
                // Not in the router table, treat like a single controller.
                $this->nowController = $this->urlSegment[0];
                $this->nowFunction = 'index';
                return true;
            }
        }else{
            // Check if in the router first
            if(key_exists($this->urlSegment[0] . '/' . $this->urlSegment[1], $this->router)){
                $routerValue = $this->router[$this->urlSegment[0] . '/' . $this->urlSegment[1]];

                // Empty, error
                if($routerValue === ''){
                    return false;
                }

                var_dump($routerValue);
                $routerValue = explode('/', trim($routerValue, '/'));
                $this->nowController = $routerValue[0];
                if(isset($routerValue[1])){
                    $this->nowFunction = $routerValue[1];
                }else{
                    $this->nowFunction = 'index';
                }
                return true;
            }else{
                // Not in the router table, treat like a single controller.
                $this->nowController = $this->urlSegment[0];
                $this->nowFunction = $this->urlSegment[1];
                return true;
            }
        }
    }

    public function get_controller(){
        return $this->nowController;
    }

    public function get_function(){
        return $this->nowFunction;
    }
}