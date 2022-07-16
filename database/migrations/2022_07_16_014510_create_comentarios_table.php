<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Crear la tabla comentarios (de los post) en la base de datos con los siguientes campos:
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id(); // id de la tabla
            $table->foreignId('user_id')->constrained(); // id de la tabla users
            $table->foreignId('post_id')->constrained(); // id de la tabla posts
            $table->string('comentario'); // comentario de los post
            $table->timestamps(); // crea dos campos, created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
};
