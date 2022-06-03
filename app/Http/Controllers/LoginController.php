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
}
