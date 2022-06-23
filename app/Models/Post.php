<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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
}
