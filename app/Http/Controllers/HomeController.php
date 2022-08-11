<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // El método __construct se ejecuta automáticamente cuando se crea una instancia de la clase
    public function __construct()
    {
        // El método middleware se encarga de verificar si el usuario está autenticado o no
        // De esta manera protegemos las rutas que requieren autenticación
        // Si el usuario no está autenticado se redirecciona a la ruta login
        $this->middleware('auth');
    }

    // __invoke => Método que se ejecuta cuando se invoca la clase
    function __invoke()
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        // Filtramos los Post por los Usuarios que seguimos
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', compact('posts'));
    }
}
