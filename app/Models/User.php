<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos protegidos por laravel, donde este espera que el usuario haga el INSERT.
     * Cada vez que se creá un campo nuevo en la tabla "users" se debe agregar en este array.
     * De lo contrario, se obtendrá el mensaje:
     * SQLSTATE[HY000]: General error: 1364 Field '[NOMBRE_CAMPO]' doesn't have a default value
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Creamos la relación  "de Una a Muchos" del Modelo "User" con el Modelo "Post"
    // con Tinker podremos testear la relación con el siguiente código:
    /*
        $usuario = User::find(1)  => Parametro: ID USUARIO
        $usuario->posts           => Nos devolverá los registros de la tabla "posts" que esten relacionados con el Usuario obtenido anteriormente
    */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
