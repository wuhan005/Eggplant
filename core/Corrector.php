<?php
namespace EP;

use Exception;

set_error_handler(function ($errNo, $errStr, $errFile, $errLine) {
    header('Content-type: text/html;');
    header("HTTP/1.1 500 Internal Server Error");

    // Get the code lines
    $numCount = 5;
    $lines = [];
    if (null !== ($contents = file_get_contents($errFile))) {
        $lines = explode("\n", $contents);
        $start  = $errLine - $numCount;
        $length = 2 * $numCount;
        $lines = array_slice($lines, $start, $length, true);
    }

    $errorData = array(
        'msg' =>$errStr,
        'path' => $errFile,
        'line' => $errLine,
        'code' => $lines,
        'trace' => array(),
    );

    require_once(COREPATH . '/templete/Error.php');
    exit();
});

set_exception_handler(function ($e) {
    header('Content-type: text/html;');
    header("HTTP/1.1 500 Internal Server Error");

    // Get the code lines
    $numCount = 5;
    $lines = [];
    if (null !== ($contents = file_get_contents($e->getFile()))) {
        $lines = explode("\n", $contents);
        $start  = $e->getLine() - $numCount;
        $length = 2 * $numCount;
        $lines = array_slice($lines, $start, $length, true);
    }

    $errorData = array(
        'msg' => $e->getMessage(),
        'path' => $e->getFile(),
        'line' => $e->getLine(),
        'code' => $lines,
        'trace' => $e->getTrace(),
    );

    require_once(COREPATH . '/templete/Error.php');
    exit();
});

function arrayToString($array) {
    if (is_array($array)){
        return implode(', ', array_map('EP\arrayToString', $array));
    }
    return $array;
}


class Corrector{
    private function __construct(){}
    private function __clone(){}

    static $errorType = array(
        100 => 'Could not find Eggplant core file `%s`, please check or reinstall Eggplant.',
        101 => 'Could not find Eggplant app file `%s`, please check your app folder or reinstall Eggplant.',
        102 => 'Database connect error. Please check the /app/Config.php.',
        999 => 'Unknown error.'
    );
}

class ParameterError extends Exception {
    public function __construct($paramName = [], $code = 0, $previous = null){
        if(is_array($paramName)){
            parent::__construct('Parameter input error: ' . implode(', ', $paramName), $code, $previous);
        }else{
            parent::__construct($paramName, $code, $previous);
        }
    }
}

//class ErrException extends Exception{
//    public function phpMsg(){
//        return $this->message;
//    }
//}