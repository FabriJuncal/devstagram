<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // Validación
        $this->validate($request, [
            'comentario' => 'required|max:255', // El campo "comentario" es requerido y su longitud máxima es 255
        ]);

        // Almacenar el resultado
        Comentario::create([
            'user_id' => auth()->user()->id, // El ID del usuario autenticado
            'post_id' => $post->id, // El ID del post al que se le agrega el comentario
            'comentario' => $request->comentario // El comentario que se agrega al post
        ]);

        // Imprimir el mensaje
        return back()->with('mensaje', 'Comentario agregado correctamente');
    }
}
