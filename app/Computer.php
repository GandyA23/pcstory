<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $table = 'computer';

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

    public static function destroy($computer){
        $computer->destroy();
    }
}
