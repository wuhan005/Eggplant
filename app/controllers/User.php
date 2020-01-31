<?php

use EP\Callback;
use EP\Controller;

class User extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function Register(){
        // Get the input JSON
        $inputData = $this->input->json();

        if($inputData === null){
            Callback::error('Payload error', 40300);
        }

        if(!$this->check->has_key(['username', 'password'], $inputData)){
            Callback::error('Missing param', 40301);
        }

        $data = array(
            'ID' => null,
            'UserName' => $inputData['username'],
            'Password' => $inputData['password']
        );

        if($this->db->isRepeat('Users', ['UserName'], $inputData['username'])){
            Callback::error('User name repeated');
            return;
        }

        if($this->db->insert('Users', $data)){
            Callback::success('', 'Success');
        }else{
            Callback::error('Database error', '');
        }


    }
}