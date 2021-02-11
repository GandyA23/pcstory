<?php

namespace App\Http\Controllers;

use App\Computer;

use Illuminate\Support\Facades\Storage; //Necesario para guardar la imagen
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index(){
        $computer = Computer::all();
        return view('computer.view')->with('computers', $computer);
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

        $status = 0;

        //Extraigo la extensión del archivo
        $extension = $request->file('logo')->extension();
        $response = Computer::store($request->brand_id, $request->os_id, $request->model, $request->description, $extension);

        if(!empty($response)){
            //Guardar recibcomputer de pago en el Storage
            Storage::putFileAs(
                'computer', $request->file('logo'), $response->id.'.'.$extension
            );

            $status = 1 ;
        }

        return $this->index()->with('status', $status);
    }

    public function delete(computer $computer){
        $status = 0;

        if(isset($esqueleto)){
            computer::destroy($computer);

            $status = 2 ;
        }

        return $this->index()->with('status', $status);
    }
}
