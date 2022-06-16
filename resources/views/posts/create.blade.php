{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center text-sm">
        <div class="md:w-6/12 max-w-2xl">
            <form  id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            </form>
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            {{-- route('string') => con esta función hacemos referencia al Alias de la ruta --}}
            {{-- novalidate => Deshabilita la validación de HTML5 --}}
            <form action="{{ route('register') }}" method="POST" novalidate>
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
                    value="{{ old('titulo') }}">

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
                    <input
                    id="descripcion"
                    name="descripcion"
                    type="text"
                    placeholder="Descripción de la Publicación"
                    class="border p-2 w-full rounded-lg @error('descripcion') border-red-500 @enderror"
                    value="{{ old('descripcion') }}">

                    @error('descripcion')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
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
