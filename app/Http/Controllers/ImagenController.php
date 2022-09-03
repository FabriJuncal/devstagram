<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    // Controlador que se encarga de subir las imagenes al servidor
    // (Request $request) => Instanciamos la clase Request para obtener los datos de la petición
    public function store(Request $request)
    {
        // Obtenemos los datos del archivo que se subió
        $imagen = $request->file('file');

        // Creamos un nombre aleatorio para el archivo
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Pasamos como parametro la imagen que se quiere subír a la función de Intervention.io
        // De esta forma vamos a poder manipular la imagen antes de subirla al servidor
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000, null, 'center'); // Redimensionamos la imagen a 1000x1000px y definimos que corte en el centro

        // Validamos si existe el directorio
        if(!file_exists(public_path('uploads'))){
            // Si no existe creamos el directorio
            mkdir(public_path('uploads'), 0777, true);
        }

        // Definimos la ruta donde vamos a almacenar la imagen
        $imagenPath = public_path('uploads/' . $nombreImagen);
        // Guardamos la imagen en la ruta definida
        $imagenServidor->save($imagenPath);

        // response()->json() => Es un Helper de Laravel que se utiliza para devolver una respuesta en formato JSON
        return response()->json(['imagen' => $nombreImagen]);
    }
}
