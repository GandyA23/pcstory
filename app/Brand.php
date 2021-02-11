<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';

    public static function store($name, $description, $extension){
        $brand = new Brand();
        $brand->name = $name;
        $brand->description = $description;
        $brand->extension = $extension;
        $brand->save();

        return $brand;
    }

    public static function destroy($brand){
        $brand->destroy();
    }
}
