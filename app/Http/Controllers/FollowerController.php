<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    // Instanciamos la Clase User que será el Usuario que se va a seguír
    public function store(User $user){
        //->attach() => Se utiliza este método cuando se quiere hacer un INSERT que relaciona dos tablas en una haciendo uso de la relación "Muchos a Muchos".
        // Por ejemplo teniendo la siguiente relación:
        // Users.id => 1 Seguirá a Users.id => 8
        // Se hará el INSERT siguiente:
        // INSERT INTO followers (user_id, follower_id) VALUES (8, 1)
        $user->followers()->attach(auth()->user()->id);

        // back() => Regresa a la página anterior.
        return back();
    }

    public function destroy(User $user){
        // ->detach() => Se utiliza este método cuando se quiere hacer un DELETE que elimina la relación "Muchos a Muchos" de una tabla.
        // Por ejemplo teniendo la siguiente relación:
        // Users.id => 1 dejará de seguir al Users.id => 8
        // Se hará el DELETE siguiente:
        // DELETE FROM followers WHERE user_id = 8 AND follower_id = 1
        $user->followers()->detach(auth()->user()->id);

        // back() => Regresa a la página anterior.
        return back();
    }
}
