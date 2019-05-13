<?php
namespace EP\Utils\X;
// Security part

class Check{
    public function __construct(){

    }

    public function has_key($element, array $source = []){

        if(is_array($element)){
            foreach($element as $value){
                if(!key_exists($value, $source)){
                    return false;
                }
            }
            return true;
        }else{
            // String, just one element
            return key_exists($element, $source);
        }
    }

}