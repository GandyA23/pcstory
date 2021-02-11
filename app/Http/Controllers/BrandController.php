<?php

namespace App\Http\Controllers;

use App\Brand;

use Illuminate\Support\Facades\Storage; //Necesario para guardar la imagen
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brand = Brand::all();
        return view('brand.view')->with('brands', $brand);
    }

    // Reglas de validación: https://laravel.com/docs/7.x/validation#available-validation-rules
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'logo' => 'required|file'
        ]);

        $status = 'danger';
        $msg = '!Error! Error al ingresar la marca.';

        //Extraigo la extensión del archivo
        $extension = $request->file('logo')->extension();
        $response = Brand::store($request->name, $request->description, $extension);

        if(!empty($response)){
            //Guardar recibbrand de pago en el Storage
            Storage::putFileAs(
                'brand', $request->file('logo'), $response->id.'.'.$extension
            );

            $status = 'success';
            $msg = '!Éxito! Se ha ingresado la marca.';
        }

        return redirect()->route('brand')->with('status', $status)->with('msg', $msg);
    }

    public function delete(Brand $brand){
        $status = 'danger';
        $msg = '!Error! Error al eliminar la marca.';

        if(isset($brand)){
            $brand->delete();
            $status = 'success';
            $msg = '!Éxito! Se ha eliminado la marca.';
        }

        return redirect()->route('brand')->with('status', $status)->with('msg', $msg);
    }
}
