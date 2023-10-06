<?php

namespace App\Controllers;

use App\Repos\ItemRepos;

class ItemController extends CRUDController
{

    protected function repos()
    {
        return new ItemRepos();
    }
}