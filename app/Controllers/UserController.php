<?php

namespace App\Controllers;

class UserController
{
    public function loginAction(){
        $data = data_json();

            $res = ['name' => 'test' ,'token' => '123456'];
            echo_json_success($res);


    }


}