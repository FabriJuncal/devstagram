<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // __invoke => Método que se ejecuta cuando se invoca la clase
    function __invoke()
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        // Filtramos los Post por los Usuarios que seguimos
        $posts = Post::whereIn('user_id', $ids)->paginate(20);

        return view('home', compact('posts'));
    }
}
