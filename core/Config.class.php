<?php

class EP_Config {

    private $config = [];

    public function __construct(){
        // Check the config file is existed or not.
        if(file_exists(APPPATH . 'Config.php')){
            require(APPPATH . 'Config.php');    // Use `require`
            $this->config = $config;
        }else{
            // TODO
        }
    }

    public function get($key){
        if(isset($this->config[$key])){
            return $this->config[$key];
        }else{
            return null;
        }
    }
}