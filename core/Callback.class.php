<?php

class EP_Callback{
    private function __construct(){}
    private function __clone(){}

    static public function success($data = [], $msg = 'OK', $code = 200){
        echo(json_encode(array(
           'code' => $code,
           'data' => $data,
           'msg' => $msg
        )));
        return;
    }

    static public function error($msg = 'Error', $code = 500){
        echo(json_encode(array(
            'code' => $code,
            'msg' => $msg
        )));
        return;
    }

}