<?php

// Used to get the request input

class EP_Util_Input{
    public function __construct(){

    }

    // GET Method
    public function get($name){
        if(isset($_GET[$name])) {
            return $_GET[$name];
        }else{
            return NULL;
        }
    }

    // POST Method
    public function post($name){
        if(isset($_POST[$name])) {
            return $_POST[$name];
        }else{
            return NULL;
        }
    }

    // JSON Input
    public function json_key($name){
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

    public function json($name){
        $data = file_get_contents('php://input');

        try{
            $data = json_decode($data, true);
            return $data;
        } catch (Exception $e){
            return null;
        }
    }

    // Get Toke in the header
    public function token(){
        try{
            // Apache
            $headers = getallheaders();
            $authorization = $headers[TOKEN_HEADER] ?? '';
        }catch (Exception $e){
            // Nginx
            $authorization = $_SERVER[strtoupper('HTTP_' . TOKEN_HEADER)] ?? '';
        }

        $reg = str_replace('(:token)', '/(.*)/i', TOKEN_FORMAT);
        preg_match($reg, $authorization,  $token);

        if(count($token) === 2){
            return $token[1];
        }else{
            return null;
        }
    }

}