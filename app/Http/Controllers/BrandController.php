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

        $status = 0;

        //Extraigo la extensión del archivo
        $extension = $request->file('logo')->extension();
        $response = Brand::store($request->name, $request->description, $extension);

        if(!empty($response)){
            //Guardar recibbrand de pago en el Storage
            Storage::putFileAs(
                'brand', $request->file('logo'), $response->id.'.'.$extension
            );

            $status = 1 ;
        }

        return $this->index()->with('status', $status);
    }

    public function delete(Brand $brand){
        $status = 0;

        if(isset($esqueleto)){
            Brand::destroy($brand);

            $status = 2 ;
        }

        return $this->index()->with('status', $status);
    }
}
