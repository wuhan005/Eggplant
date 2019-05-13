<?php
define('COREPATH', dirname(dirname(__FILE__)) . '/');
define('APPPATH', dirname(dirname(dirname(__FILE__))) . '/app/');
define('UTILSPATH', dirname(dirname(dirname(__FILE__))) . '/utils/');
define('CLIPATH', dirname(__FILE__) . '/');

define('EP_VERSION', '0.0.1');
define('EP_FOOTER', 'Eggplant CLI tools');

require_once(COREPATH . 'Utils.class.php');         // Utils
require_once(APPPATH . 'Utils.php');                 // Utils config
use EP\Utils;

if(MODE !== 'CLI'){
    exit();
}

class CLI{
    private $argv;
    private $argc;

    private $route = array(
        'config' => 'config',
        'utils' => 'utils',
    );

    public function __construct($argv, $argc){
        $this->argv = $argv;
        $this->argc = $argc;

        print($this->headerLogo);
        print(EP_FOOTER . '    Version:' . EP_VERSION. "\n\n\n");

        if($this->argc === 1){
            print($this->helpInfo);
            return;
        }else{
            if(key_exists($this->argv[1], $this->route)){
                $this->{$this->route[$argv[1]]}();

            }else{
                printf("  未知的指令：%s\n", $this->argv[1]);
                print($this->helpInfo);
                return;
            }
        }
    }

    public function __destruct(){
        print("\n\n");
    }

    public function config(){

    }

    public function utils(){
        if(isset($this->argv[2])){

        }else{
            // uitls
            foreach(EP\Utils::$Utils as $fileName) {
                if (!file_exists(UTILSPATH . $fileName . '.php')) {
                   printf("> %s | Error. Not found!\n", $fileName);
                }else{
                    printf("> %s | /app/utils/%s.php\n", $fileName, $fileName);
                }
            }
        }
    }


    private $headerLogo = <<<ET

  _____                  _             _   
 | ____|__ _  __ _ _ __ | | __ _ _ __ | |_ 
 |  _| / _` |/ _` | '_ \| |/ _` | '_ \| __|
 | |__| (_| | (_| | |_) | | (_| | | | | |_ 
 |_____\__, |\__, | .__/|_|\__,_|_| |_|\__|
       |___/ |___/|_|
 
 
ET;

    private $helpInfo = <<<ET
    
> config = 查看 Eggplant 配置
> config set <key> <value> 修改 Eggplant 配置
> utils - 查看已安装的 Utils
> utils add <util_name> - 安装 Util
> uitls delete <util_name> - 删除 Util


ET;

}

