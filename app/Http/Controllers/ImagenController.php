<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    // Controlador que se encarga de subir las imagenes al servidor
    // (Request $request) => Instanciamos la clase Request para obtener los datos de la petición
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        // response()->json() => Es un Helper de Laravel que se utiliza para devolver una respuesta en formato JSON
        return response()->json(['imagen' => $imagen->extension()]);
    }
}
