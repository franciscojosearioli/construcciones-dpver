<?php

namespace App\Http\Controllers;

use App\Obra;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    public function vista(){
        return redirect('obra/vista');
    }
    public function agregar(Request $request){
        $obra = new Obra();

        $obra -> nombre = $request -> nombre;
        $obra -> expediente = $request -> expediente;
        $obra -> ubicacion = $request -> ubicacion;
        $obra -> descripcion = $request -> descripcion;
        $obra -> estado = $request -> estado;

        $obra -> save();

        return redirect('obra/agregar');

    }
}
