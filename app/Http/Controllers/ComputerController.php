<?php

namespace App\Http\Controllers;

use App\Computer;
use App\Os;
use App\Brand;

use Illuminate\Support\Facades\Storage; //Necesario para guardar la imagen
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index(){
        $computer = Computer::where('id', '>=', 1);
        $computer = $computer->with('os')->with('brand');
        $computer = $computer->get();
        $oses = Os::all();
        $brands = Brand::all();
        return view('computer.view')
            ->with('computers', $computer)
            ->with('brands', $brands)
            ->with('oses', $oses);
    }

    // Reglas de validación: https://laravel.com/docs/7.x/validation#available-validation-rules
    public function store(Request $request){
        $request->validate([
            'brand_id' => 'required|integer',
            'os_id' => 'required|integer',
            'model' => 'required|string',
            'description' => 'required|string',
            'logo' => 'required|file'
        ]);

        $status = 'danger';
        $msg = '!Error! Error al ingresar la computadora.';

        //Extraigo la extensión del archivo
        $extension = $request->file('logo')->extension();
        $response = Computer::store($request->brand_id, $request->os_id, $request->model, $request->description, $extension);

        if(!empty($response)){
            //Guardar recibcomputer de pago en el Storage
            Storage::putFileAs(
                'computer', $request->file('logo'), $response->id.'.'.$extension
            );

            $status = 'success';
            $msg = '!Éxito! Se ha ingresado la computadora.';
        }

        return redirect()->route('computer')->with('status', $status)->with('msg', $msg);
    }

    public function delete(Computer $computer){
        $status = 'danger';
        $msg = '!Error! Error al eliminar la computadora.';

        if(isset($computer)){
            $computer->delete();

            $status = 'success';
            $msg = '!Éxito! Se ha eliminado la computadora.';
        }

        return redirect()->route('computer')->with('status', $status)->with('msg', $msg);
    }
}
