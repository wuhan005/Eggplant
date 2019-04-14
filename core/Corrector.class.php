<?php

set_error_handler(function ($errNo, $errStr, $errFile, $errLine) {
    var_dump([$errNo, $errStr, $errFile, $errLine]);
});

set_exception_handler(function (Exception $e) {
    header('Content-type: text/html;');
    header("HTTP/1.1 500 Internal Server Error");

//    var_dump($except);
//    $errorData = array(
//        'phpMsg' => $except['message']
//    );
//    var_dump($errorData);

//    $errorMsg = vsprintf(self::$errorType[$errCode], $params);

    var_dump($e->getMessage());
    var_dump($e->getTrace());

    require_once(COREPATH . '/templete/Error.php');
    exit();
});

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

//class ErrException extends Exception{
//    public function phpMsg(){
//        return $this->message;
//    }
//}