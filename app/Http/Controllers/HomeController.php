<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    // __invoke => Método que se ejecuta cuando se invoca la clase
    function __invoke()
    {
        return view('home');
    }
}
