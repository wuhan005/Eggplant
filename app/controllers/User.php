<?php

class User extends EP_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function Register(){
        // Get the input JSON
        $inputData = $this->input->json();

        if($inputData === null){
            EP_Callback::error('Payload error', 40300);
        }

        if(!$this->check->has_key(['username', 'password'], $inputData)){
            EP_Callback::error('Missing param', 40301);
        }

        $data = array(
            'ID' => null,
            'UserName' => $inputData['username'],
            'Password' => $inputData['password']
        );

        if($this->db->isRepeat('Users', 'UserName', $inputData['username'])){
            return EP_Callback::error('User name repeated');
        }

        if($this->db->insert('Users', $data)){
            EP_Callback::success('', 'Success');
        }else{
            EP_Callback::error('Database error', '');
        }


    }
}