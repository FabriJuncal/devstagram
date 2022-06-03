<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        // Se utiliza "." en vez de "/" para indicar que se está accediendo a una ruta relativa
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd() => Esta función sirve para imprimir en pantalla los datos que se le pasan como parámetro y se detiene la ejecución del programa.
        // $request => Esta variable contiene todos los datos que se envían desde el formulario de registro.
        // dd($request);

        // Esta función sirve para obtener uno de los datos que se envían desde el formulario de registro.
        // dd($request->get('username'));


        // $this->validate(Instancia del "Request", Array con las reglas de validación) => Esta función sirve para validar los datos que se envían desde el formulario de registro.
        $this->validate($request, [
            'email' => 'required|email', // El email es requerido y debe ser un email válido.
            'password' => 'required', // El password es requerido.
        ]);
    }
}
