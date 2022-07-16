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

        {{-- @auth => Directiva de Laravel que permite que todo lo que se encuentre dentro, solo lo puedan ver los usuarios autenticados --}}
        @auth

            <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

            {{-- Mostramos el mensaje retornado por medio de la función back()->with() en el controlador --}}
            {{-- los mensajes retornados por la función back()->with() se almacenan en la sesión, y se obtiene con la función "session([VARIABLE_DEFINIDA_EN_EL_CONTROLADOR])" --}}
            @if(session('mensaje'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                    {{ session('mensaje') }}
                </div>
            @endif

            <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                {{-- @csrf => Se utiliza esta función para generar un hash de seguridad que se utilizará para cada petición que se realice --}}
                @csrf

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

        <div class="bg-white shadow mb-5 max-h-96 mt-10">
            @if($post->comentarios->count())
                @foreach($post->comentarios as $comentario)
                    <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('post.index', $comentario->user) }}" class="font-bold">
                                {{ $comentario->user->username }}
                            </a>
                            <p class="mt-2">{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            @else

            @endif
        </div>

    </div>
</div>

@endsection
