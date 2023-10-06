<?php

namespace App\Controllers;

abstract class CRUDController

{
    protected abstract function repos();
    public function updateAction(){
        $data = data_json();
        $this->repos()->update($data);
        echo_json_success();
    }

    public function deleteAction(){
        $data = data_json();
        $this->repos()->delete($data['id']);
        echo_json_success();

    }

    public function getAction(){
        $data = data_json();
        $this->repos()->get($data['id']);
        echo_json_success();

    }

}