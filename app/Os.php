<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    protected $table = 'os';

    public static function store($name, $description, $extension){
        $os = new Os();
        $os->name = $name;
        $os->description = $description;
        $os->extension = $extension;
        $os->save();

        return $os;
    }
}
