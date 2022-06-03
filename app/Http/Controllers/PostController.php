<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // Valida que haya un Usuario Autenticado, de esta manera protegemos la ruta en el cual se requiere que el usuario se encuentre logeado
        // Por defecto redirecciona a la ruta "login", por lo tanto hay que crear esta vista en la carpeta "resources/views/auth"
        $this->middleware('auth');
    }

    public function index()
    {
        // auth()->user() => Esta función sirve para obtener el objeto de autenticación de Laravel.
        //                   Este muestra los datos del usuario que se encuentra autenticado.
        // dd(auth()->user());

        return view('dashboard');
    }
}
