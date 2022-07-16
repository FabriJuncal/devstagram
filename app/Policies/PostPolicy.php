<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // POLICY => Es una función que se encarga de validar si el usuario autenticado tiene permisos para realizar una acción.
    // Por ejemplo, actualizar un registro o eliminarlo.

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Post $post)
    {
        // Validamos que el Usuario que creó el Post, sea el mismo que quiera eliminarlo
        return $user->id === $post->user_id;
    }

}
