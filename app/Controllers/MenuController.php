<?php

namespace App\Controllers;

use App\Repos\ItemRepos;
use App\Repos\MenuRepos;

class MenuController extends CRUDController
{
    protected function repos()
    {
        return new MenuRepos();
    }

    public function createAllAction(){
        $menuRepos = $this->repos();
        $itemRepos = new ItemRepos();

        $data = data_json();


        foreach ($data['menus'] as $index_menu => $menu){
            $menu['store_id'] = $data['store_id'];
            $menu['sort'] = $index_menu + 1;
            $menu['status'] =  1;
            $menu_id = $menuRepos->update($menu);

            foreach ($menu['items'] as $index_item => $item){

                $item['sort'] = $index_item + 1;
                $item['menu_id'] = $menu_id;
                $item['status'] =  1;
                $itemRepos->update($item);

            }
        }

    }

    public function getAll(){

    }



}