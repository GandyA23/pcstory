<?php

namespace App\Http\Controllers;

use App\Os;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage; //Necesario para guardar la imagen
use Illuminate\Http\Request;

class OsController extends Controller{

    public function index(){
        $os = Os::all();
        return view('os.view')->with('oses', $os);
    }

    // Reglas de validación: https://laravel.com/docs/7.x/validation#available-validation-rules
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'logo' => 'required|file'
        ]);

        $status = 0;

        //Extraigo la extensión del archivo
        $extension = $request->file('logo')->extension();
        $response = Os::store($request->name, $request->description, $extension);

        if(!empty($response)){
            //Guardar recibos de pago en el Storage
            Storage::putFileAs(
                'os', $request->file('logo'), $response->id.'.'.$extension
            );

            $status = 1 ;
        }

        return $this->index()->with('status', $status);
    }

    public function delete(Os $os){
        $status = 0;

        if(isset($esqueleto)){
            Os::destroy($os);

            $status = 2 ;
        }

        return $this->index()->with('status', $status);
    }
}
