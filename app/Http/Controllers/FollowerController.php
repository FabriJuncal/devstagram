<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    // Instanciamos la Clase User que será el Usuario que se va a seguír
    public function store(User $user){
        //->attach() => Se utiliza este método cuando se quiere hacer una relación con la misma tabla en general.
        $user->followers()->attach(auth()->user()->id);

        return back();
    }
}
