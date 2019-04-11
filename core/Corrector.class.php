<?php

class Corrector{
    private function __construct(){}
    private function __clone(){}

    static $errorType = array(
        100 => 'Could not find Eggplant core file `%s`, please check or reinstall Eggplant.',
        101 => 'Could not find Eggplant app file `%s`, please check your app folder or reinstall Eggplant.',
        999 => 'Unknow error.'
    );

    static function Show($errCode = 999, $params = [], $tips = ''){
        //header('Content-type: text/html;');
        $errorMsg = vsprintf(self::$errorType[$errCode], $params);
        echo($errorMsg);
        exit();
    }
}