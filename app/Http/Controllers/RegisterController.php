<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //Por convención los controladores deben tener un método llamado "index" cuando este tenga solo 1 método
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd() => Esta función sirve para imprimir en pantalla los datos que se le pasan como parámetro y se detiene la ejecución del programa.
        // $request => Esta variable contiene todos los datos que se envían desde el formulario de registro.
        // dd($request);


        // $request->get('string') => Esta función sirve para obtener uno de los datos que se envían desde el formulario de registro.
        // dd($request->get('username'));
    }
}
