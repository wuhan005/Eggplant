<?php
namespace EP;

class Callback{
    private function __construct(){}
    private function __clone(){}
    private static $backed = false;     // 确保只显示第一个 Callback

    static public function success($data = [], $msg = 'OK', $error = 0){
        ob_clean();
        echo(json_encode(array(
           'error' => $error,
           'data' => $data,
           'msg' => $msg
        )));
        if(!self::$backed){
            ob_flush();
            self::$backed = true;
        }else{
            ob_clean();
        }
    }

    static public function error($msg = 'Error', $error = 500){
        ob_clean();
        echo(json_encode(array(
            'error' => $error,
            'msg' => $msg
        )));
        if(!self::$backed){
            ob_flush();
            self::$backed = true;
        }else{
            ob_clean();
        }
    }

}