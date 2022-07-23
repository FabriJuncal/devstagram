<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    // __construct() => Es un método constructor de la clase, es decir, se ejecuta siempre que se crea una nueva instancia de la clase.
    public function __construct()
    {
        // $this->middleware('auth'):
        // Valida que haya un Usuario Autenticado, de esta manera protegemos la ruta en el cual se requiere que el usuario se encuentre logeado
        // Por defecto redirecciona a la ruta "login", por lo tanto hay que crear esta vista en la carpeta "resources/views/auth"
        $this->middleware('auth');
    }

    public function index()
    {
        dd('Aquí se muestra el formulario');
    }
}
