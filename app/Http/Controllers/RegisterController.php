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

    public function store()
    {
        dd('Post...');
    }
}
