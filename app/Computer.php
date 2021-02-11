<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $table = 'computer';

    public function os(){
        return $this->hasOne('App\Os', 'id', 'os_id');
    }

    public function brand(){
        return $this->hasOne('App\Brand', 'id', 'brand_id');
    }

    public static function store($brand_id, $os_id, $model, $description, $extension){
        $computer = new computer();
        $computer->brand_id = $brand_id;
        $computer->os_id = $os_id;
        $computer->model = $model;
        $computer->description = $description;
        $computer->extension = $extension;
        $computer->save();

        return $computer;
    }
}
