<?php

class EP_Controller{
    protected $db;

    public function __construct(){
        $this->db = Database::_construct();
    }

    // Get Method
    public function get($name){
        if(isset($_GET[$name])) {
            return $_GET[$name];
        }else{
            return NULL;
        }
    }

    // Post Method
    public function post($name){
        if(isset($_POST[$name])) {
            return $_POST[$name];
        }else{
            return NULL;
        }
    }

    // JSON Input
    public function getJSON($name){
        $data = file_get_contents('php://input');

        try{
            $data = json_decode($data, true);
            if($name === null || $data === null){
                return null;
            }

            if(array_key_exists($name, $data)){
                return $data[$name];
            }
            return null;

        } catch (Exception $e){
            return null;
        }
    }

    public function getOption($key){
        $query = $this->db->query('SELECT * FROM `Options` WHERE `OptionKey` = ?', [$key]);

        if(!empty($query)){
            return $query[0]['OptionValue'];
        }else{
            return '';
        }
    }

    // Get Toke in the header
    public function getToken(){
        try{
            // Apache
            $headers = getallheaders();
            $authorization = $headers['Authorization'] ?? '';
        }catch (Exception $e){
            // Nginx
            $authorization = $_SERVER['HTTP_uthorization'] ?? '';
        }

        return $authorization;
    }

    public function tokenVaild(){
        $token = $this->getToken();
        $query = $this->db->query('SELECT * FROM `Users` WHERE `Token` = ?', [$token]);
        if(empty($query)){
            return false;
        }else{
            return $token;
        }
    }

}