<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comentario;
use App\Models\like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Return_;

class Post extends Model
{
    use HasFactory;

    // Atributos protegidos por laravel, donde este espera que el usuario haga el INSERT.
    // Cada vez que se creá un campo nuevo en la tabla "comentarios" se debe agregar en este array.
    // De lo contrario, se obtendrá el mensaje:
    // SQLSTATE[HY000]: General error: 1364 Field '[NOMBRE_CAMPO]' doesn't have a default value
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Creamos la relación  "de Muchos a Uno" del Modelo "Post" con el Modelo "User"
    // con Tinker podremos testear la relación con el siguiente código:
    /*
        $post = Post::find(2)  => Parametro: ID POST
        $post->user           => Nos devolverá los registros de la tabla "users" que esten relacionados con el Post obtenido anteriormente
    */
    public function user()
    {
        // belongsTo() => Método que hace la relación de "Muchos a Uno"
        //  -> Parametro => Modelo con el que se quiere relacionar

        // select() => Equivalente SELECT de SQL
        //  -> Parametro => Array con los nombres de los campos de la tabla que se quiere obtener
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        // hasMany() => Método que hace la relación de "Muchos a Muchos"
        //  -> Parametro => Modelo con el que se quiere relacionar
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        // hasMany() => Método que hace la relación de "Muchos a Muchos"
        //  -> Parametro => Modelo con el que se quiere relacionar
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        // Si el usuario ya ha dado like a este post, devuelve true
        // constains() => Método que comprueba si un array contiene un elemento dado y retorna true o false
        return $this->likes->contains('user_id', $user->id);
    }
}
