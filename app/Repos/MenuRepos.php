<?php

namespace App\Repos;

class MenuRepos extends BaseRepos
{
    const TABLE = 'menu';
    const COLUMN = [
        'name' ,
        'store_id',
        'sort',
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