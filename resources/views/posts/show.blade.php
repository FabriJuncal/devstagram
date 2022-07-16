{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')

<div class="md:flex md:justify-center md:gap-10 md:items-center text-sm">
    <div class="md:w-6/12 max-w-lg">
        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

        <div class="p-3">
            0 Likes
        </div>

        <div>
            <p class="font-bold">{{ $post->user->username }}</p>
            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            <p class="mt-5">{{ $post->descripcion }}</p>
        </div>
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">

        {{-- @auth => Herlper de Laravel que permite que todo lo que se encuentre dentro, solo lo puedan ver los usuarios autenticados --}}
        @auth

            <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>
            <form>
                <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Añade un comentario
                    </label>
                    {{-- old('[string]') => con esta función hacemos referencia al valor que se había ingresado en el campo y al resetear el formulario por la validación, no se pierde el valor de este campo --}}
                    {{-- ¡¡ADVERTENCIA!! --}}
                    {{-- No tiene que haber Salto de Linea entre la Etiqueta de Apertura y Cierre del "Textarea", sino se rompe el estilo del elemento --}}
                    <textarea
                    id="comentario"
                    name="comentario"
                    placeholder="Descripción de la Publicación"
                    rows="4"
                    class="border p-2 w-full rounded-lg @error('comentario') border-red-500 @enderror">{{ old('comentario') }}</textarea>
                    @error('comentario')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>

                <input
                    type="submit"
                    value="Comentar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>

        @endauth

    </div>
</div>

@endsection
