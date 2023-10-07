<?php

namespace App\Controllers;

use App\Repos\StoreRepo;

class StoreController
{
    const TABLE = 'store';
    const COLUMN = [
        'name' ,
        'phone' ,
        'address' ,
        'ward_id' ,
        'district_id',
        'city_id' ,
        'store_type',
        'wifi_pass' ,
        'email' ,
        'status'  ];


    public function insertAction(){
        $data = data_json();
        $store = $data['store'];
        $uuid = $data['uuid'];


        $storeRepo = new StoreRepo();
        $id = $storeRepo-> update($store);

        db()->insert('device_store', ['device_uuid' => $uuid, 'store_id' => $id,'status' => 1]);
        echo_json_success(['store_id' => $id, 'uuid' => $uuid]);
    }

    public function updateAction(){
        $data = data_json();
        $storeRepo = new StoreRepo();
        $id = $storeRepo-> update($data);
        echo_json_success($id);
    }

    public function uuidAction(){
        $data = data_json();
        $res = [];

        if ($uuid = $data['uuid']){

            $row = db_get("device_store",'*',["device_uuid" => $uuid, 'status' => 1]);
            if ($row){
                $res['store'] = $this->getStore($row['store_id']);
                $res['menus'] = $this->getMenu($row['store_id']);
            }else{
                echo_json_error();
            }
        }
        echo_json_success($res);
    }

    public function getAction(){
        $data = data_json();
        $res = [];

        if ($store_id = $data['id']){
            $res['store'] = $this->getStore($store_id);
            $res['menus'] = $this->getMenu($store_id);
        }
        echo_json_success($res);
    }

    public function getStoreByAdminAction(){
        $data = data_json();
        $res = [];

        if ($store_id = $data['id']){
            $res['store'] = $this->getStore($store_id);
            $res['menus'] = $this->getMenu($store_id);
            $res['city'] = $this->loadCity();
            $res['district'] = $this->loadDistrictByCity($res['store']['city_id']);
            $res['ward'] = $this->loadWardByDistrict($res['store']['district_id']);
        }
        echo_json_success($res);
    }

    private function getStore($id){
        $join = ['[>]ward' => ['store.ward_id' => 'id'],
            '[>]district' => ['store.district_id' => 'id'],
            '[>]city' => ['store.city_id' => 'id'],
            '[>]store_type' => ['store.store_type' => 'id']];
        $column = array_map(function ($key){
            return self::TABLE.'.'.$key;
        },self::COLUMN);
        $column = array_merge([self::TABLE.'.id',
            'ward.name(ward)','district.name(district)','city.name(city)','store_type.name(store_type_name)'],
            $column );
        $where = ['store.id' => $id];
        return db_get(self::TABLE,$join,$column,$where);
    }

    private function getMenu($store_id){
        $menus = db_select('menu', '*' ,['store_id' => $store_id]);
        $data = [];
        foreach ($menus as $menu){
            $menu['items'] = $this->getItems($menu['id']);
            $data[] = $menu;
        }
        return $data;

    }

    public function cityAction(){
        echo_json($this->loadCity());
    }

    public function districtAction(){
        $data = data_json();
        $city = $data['id'];
        echo_json($this->loadDistrictByCity($city));
    }

    public function wardAction(){
        $data = data_json();
        $district = $data['id'];
        echo_json($this->loadWardByDistrict($district));
    }

    private function getItems($menu_id){
        return db_select('item', '*' ,['menu_id' => $menu_id]);
    }

    private function loadCity(){
        return db_select('city',"*",['ORDER' => ['sort']]);
    }

    private function loadDistrictByCity($city_id){
        return db_select('district',"*",['city_id' => $city_id]);
    }
    private function loadWardByDistrict($district_id){
        return db_select('ward',"*",['district_id' => $district_id]);
    }

}