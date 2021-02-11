<?php

namespace App\Http\Controllers;

use App\Os;

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

        $status = 'danger';
        $msg = '!Error! Error al ingresar el sistema operativo.';

        //Extraigo la extensión del archivo
        $extension = $request->file('logo')->extension();
        $response = Os::store($request->name, $request->description, $extension);

        if(!empty($response)){
            //Guardar recibos de pago en el Storage
            Storage::putFileAs(
                'os', $request->file('logo'), $response->id.'.'.$extension
            );

            $status = 'success';
            $msg = '!Éxito! Se ha ingresado el sistema operativo correctamente.';
        }

        return redirect()->route('os')->with('status', $status)->with('msg', $msg);
    }

    public function delete(Os $os){
        $status = 'danger';
        $msg = '!Error! Error al borrar el sistema operativo.';

        if(isset($os)){
            $os->delete();

            $status = 'success';
            $msg = '!Éxito! Se ha eliminado el sistema operativo.';
        }

        return redirect()->route('os')->with('status', $status)->with('msg', $msg);
    }
}
