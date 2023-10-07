<?php

namespace App\Controllers;

use App\Traits\AccountTrait;

class IndexController
{
public function verifyAction(){
    $res = ['code' => 0];
    $data = data_json();
    $uuid = $data['uuid'];
    $pass = $data['pass'];

    $row = db_get("device_store",'*',["device_uuid" => $uuid, 'status' => 1]);
    if($row){
        if($pass && $pass == '4444'){
            $res['code'] = 1;
            $res['store_id'] = $row['store_id'];
        }else{
            $res['code'] = 2;
        }
    }
    echo_json($res);
}

}
