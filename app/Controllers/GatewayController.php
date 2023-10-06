<?php

namespace App\Controllers;

class GatewayController
{
    public static function indexAction()
    {
        $data = data_json();
        $url = "";
        if ($uuid = $data['uuid']) {
            $join = ['[>]platform' => ['nfc.platform' => 'id']];
            $column = ['platform.platform_url'];
            $where = ['nfc.uuid' => $uuid];
            $url = db_get('nfc', $join, $column, $where);
            $url = $url['platform_url'];
        }
        if ($url){
            echo_json_success($url);
        }
        echo_json_error();
    }
}