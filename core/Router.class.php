<?php
namespace EP;

class Router{
    private $router;
    private $router_404 = '';

    private $urlSegment;
    private $nowController;
    private $nowFunction = 'index';     // 默认方法

    public function __construct(){

        // 检查 router.php
        $filePath = APPPATH . 'Router.php';
        if(file_exists($filePath)){
            // Load the user's router
            require($filePath);
            $this->router = $router;
            if(isset($router404)){
                $this->router_404 = $router404;
            }
        }else{
            Corrector::Show(101, 'app/Router.php');
        }

        // URL 路由
        // 如果 URL 为 /, PATH_INFO 为 null
        if(isset($_SERVER['PATH_INFO'])){
            $this->urlSegment = @explode('/', trim($_SERVER['PATH_INFO'], '/'));
        }else{
            $this->urlSegment = [''];
        }

        if(!$this->handle_router()){
            // 404
            if($this->router_404 === ''){
                // 默认 404
                Callback::error("404 not found.", 40400);
            }else{
                // 自定义 404
                $routerValue = explode('/', trim($this->router_404, '/'));
                $this->nowController = $routerValue[0];
                if(isset($routerValue[1])){
                    $this->nowFunction = $routerValue[1];
                }else{
                    $this->nowFunction = 'index';
                }
            }
        }
    }

    private function handle_router(){
        $length = count($this->urlSegment);

        // URL 分段判断
        if($length === 1){
            // 先检查是否在路由表里
            if(key_exists($this->urlSegment[0], $this->router)){
                $routerValue = $this->router[$this->urlSegment[0]];
            }else{
                // 不在路由表中，直接返回 404
                return false;
            }
        }else{
            if(key_exists($this->urlSegment[0] . '/' . $this->urlSegment[1], $this->router)){
                $routerValue = $this->router[$this->urlSegment[0] . '/' . $this->urlSegment[1]];
            }else{
                return false;
            }
        }

        // 检查是否有限制请求方法
        if(is_array($routerValue)){
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            if(key_exists($requestMethod, $routerValue)){
                $routerValue = $routerValue[$requestMethod];
            }else{
                return false;
            }
        }

        if($routerValue === ''){
            return false;
        }
        $routerValue = explode('/', trim($routerValue, '/'));
        $this->nowController = $routerValue[0];
        if(isset($routerValue[1])){
            $this->nowFunction = $routerValue[1];
        }else{
            $this->nowFunction = 'index';
        }
        return true;
    }

    public function get_controller(){
        return $this->nowController;
    }

    public function get_function(){
        return $this->nowFunction;
    }
}