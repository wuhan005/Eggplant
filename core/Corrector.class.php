<?php

class Corrector{
    private function __construct(){}
    private function __clone(){}

    static $errorType = array(
        100 => 'Could not find Eggplant core file `%s`, please check or reinstall Eggplant.',
        101 => 'Could not find Eggplant app file `%s`, please check your app folder or reinstall Eggplant.',
        102 => 'Database connect error. Please check the /app/Config.php.',
        999 => 'Unknown error.'
    );

    static function Show($errCode = 999, $params = [], $tips = ''){
        header('Content-type: text/html;');
        header("HTTP/1.1 500 Internal Server Error");

        $errorMsg = vsprintf(self::$errorType[$errCode], $params);

        require_once(COREPATH . '/templete/Error.php');
        exit();
    }
}