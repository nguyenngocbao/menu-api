<?php

namespace App\Repos;

class StoreRepo extends BaseRepos
{
    const TABLE = 'store';
    const COLUMN = [
        'name' ,
        'phone',
        'address' ,
        'ward_id' ,
        'district_id' ,
        'city_id' ,
        'store_type' ,
        'wifi_pass' ,
        'email' ,
        'status' ];

    protected function table()
    {
        return self::TABLE;
    }

    protected function column()
    {
        return self::COLUMN;
    }

}