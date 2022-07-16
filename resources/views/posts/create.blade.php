{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection

{{--
    Con esta directiva hacemos referencia al espacio reservado "@stack('styles')" en donde todo lo que agregemos dentro de este, se importará en el espacio reservado
    donde se encuentra la directiva "@stack('styles')"
--}}
@push('styles')
    {{-- CDN de Dropzone: Librería para subír archivos al servidor => https://www.dropzone.dev/js/ --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center text-sm">
        <div class="md:w-6/12 max-w-2xl">
            <form action="{{ route('imagenes.store') }}"  id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            {{-- route('string') => con esta función hacemos referencia al Alias de la ruta --}}
            {{-- novalidate => Deshabilita la validación de HTML5 --}}
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                {{-- @csrf => Se utiliza esta función para generar un hash de seguridad que se utilizará para cada petición que se realice --}}
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="mb-1 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input
                    id="titulo"
                    name="titulo"
                    type="text"
                    placeholder="Titulo de la Publicación"
                    class="border p-2 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                    value="{{ old('titulo') }}"> {{-- old('[string]') => con esta función hacemos referencia al valor que se había ingresado en el campo y al resetear el formulario por la validación, no se pierde el valor de este campo --}}

                    @error('titulo')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="mb-1 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    {{-- old('[string]') => con esta función hacemos referencia al valor que se había ingresado en el campo y al resetear el formulario por la validación, no se pierde el valor de este campo --}}
                    {{-- ¡¡ADVERTENCIA!! --}}
                    {{-- No tiene que haber Salto de Linea entre la Etiqueta de Apertura y Cierre del "Textarea", sino se rompe el estilo del elemento --}}
                    <textarea
                    id="descripcion"
                    name="descripcion"
                    placeholder="Descripción de la Publicación"
                    rows="4"
                    class="border p-2 w-full rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-5">
                    <input
                    name="imagen"
                    type="hidden"
                    value="{{ old('imagen') }}"> {{-- old('[string]') => con esta función hacemos referencia al valor que se había ingresado en el campo y al resetear el formulario por la validación, no se pierde el valor de este campo --}}

                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input
                    type="submit"
                    value="Publicar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3  text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
