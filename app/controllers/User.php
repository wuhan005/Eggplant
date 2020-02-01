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

    public function Login(){
        $inputData = $this->input->json();
        $is_validate = $this->check->validate(
            array(
                'username' => ['用户名', ['string', 'maxlength: 10', 'minlength: 5'], true],
                'password' => ['密码',   ['string', 'minlength: 10'], true],
                'code'     => ['安全码', ['uint', 'length: 4'], false],
            ),
        $inputData);
        if(!$is_validate){
            Callback::error($this->check->get_error_message(), 40000);
        }
        Callback::success("111");
    }
}