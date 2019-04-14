<?php

// Security part

class EP_Util_Check{
    public function __construct(){

    }

    public function check_key($element, array $source = []){
        if(is_array($element)){
            foreach($element as $value){
                if(!in_array($value, $source)){
                    return false;
                }
                return true;
            }
        }else{
            // String, just one element
            return in_array($element, $source);
        }
    }

}