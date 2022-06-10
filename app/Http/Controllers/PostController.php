<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // Valida que haya un Usuario Autenticado, de esta manera protegemos la ruta en el cual se requiere que el usuario se encuentre logeado
        // Por defecto redirecciona a la ruta "login", por lo tanto hay que crear esta vista en la carpeta "resources/views/auth"
        $this->middleware('auth');
    }

    // Instanciamos de la clase "User" y lo pasamos como parametro al método
    public function index(User $user)
    {
        // auth()->user() => Esta función sirve para obtener el objeto de autenticación de Laravel.
        //                   Este muestra los datos del usuario que se encuentra autenticado.
        // dd(auth()->user());

        // View() => Esta función sirve para redireccionar a una vistal.
        // 1er Parametro => Nombre de la vista
        // 2do Parametro => Arreglo con los datos que se le pasan a la vista
        // compact('user') => Esta función sirve para crear un arreglo con el Key y Value iguales, es decir, es el equivalente de [user => $user]
        return view('dashboard', compact('user'));
    }


    public function create()
    {
        dd('Creando Post...');
    }
}
