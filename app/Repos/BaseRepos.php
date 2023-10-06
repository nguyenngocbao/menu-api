<?php

namespace App\Repos;

abstract class BaseRepos
{
    protected abstract function table();

    protected abstract function column();

    public function update($data){
        $id = 0;
        $d = $this->parseData($data);
        if ($id = $data['id']) {
            db()->update($this->table(), $d, ['id' => $id]);
        } else {
            db()->insert($this->table(), $d);
            $id = db()->id();

        }
        return $id;

    }

    public function delete($id)
    {
        if ($id) {
            $r = db()->delete($this->table(), ['id' => $id]);
            return db()-> id();
        }
        return 0;

    }

    public function get($id)
    {
        $data = [];
        if ($id) {
            $data = db_get($this->table(),'*', ['id' => $id]);
        }
        return $data;

    }

    private function parseData($data){
        $d = [];
        foreach ($this->column() as $col){
            $d[$col] = $data[$col];
        }
        return $d;
    }

}