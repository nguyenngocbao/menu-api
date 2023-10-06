<?php

namespace App\Repos;

class ItemRepos extends BaseRepos
{
    const TABLE = 'item';
    const COLUMN = [
        'name' ,
        'price' ,
        'sort' ,
        'menu_id',
        'status'];

    protected function table()
    {
        return self::TABLE;
    }

    protected function column()
    {
        return self::COLUMN;
    }


}