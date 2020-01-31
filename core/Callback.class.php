<?php
namespace EP;

class Callback{
    private function __construct(){}
    private function __clone(){}

    static public function success($data = [], $msg = 'OK', $error = 0){
        echo(json_encode(array(
           'error' => $error,
           'data' => $data,
           'msg' => $msg
        )));
        exit();
    }

    static public function error($msg = 'Error', $error = 500){
        echo(json_encode(array(
            'error' => $error,
            'msg' => $msg
        )));
        exit();
    }

}