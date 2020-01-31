<?php


namespace EP;


class Utils{
    public static $Utils = [];

    private $utilsObject;

    public function __construct(){
        $this->AutoLoad();
    }

    // Load the utils under the utils.
    private function AutoLoad(){
        foreach(self::$Utils as $fileName) {
            if (!file_exists(UTILSPATH . $fileName . '.php')) {
                throw(new \Exception(sprintf("The utils `%s` can not be found in `/utils` folder. Path: %s", $fileName . '.php', UTILSPATH . $fileName . '.php'), 40001));
                return;
            }
            require(UTILSPATH . $fileName . '.php');

            $className = '\EP\Utils\\' . $fileName;
            $this->utilsObject[$fileName] = new $className();       // 首字母大写 / 小写名称均可
            $this->utilsObject[strtolower($fileName)] = new $className();
        }
    }

    public function __get($name){
        return $this->utilsObject[$name];
    }

    public function __call($name, $arguments){
        return $this->utilsObject[$name];
    }
}