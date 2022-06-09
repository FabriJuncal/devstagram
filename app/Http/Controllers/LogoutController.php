<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        // auth()->logout() => Esta función sirve para cerrar la sesión del usuario.
        auth()->logout();

        // Redireccionamos al usuario al inicio.
        return redirect()->route('login');
    }
}
