{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center text-sm">
        <div class="md:w-6/12 max-w-2xl">
            <img src="" alt="Imagen Publicación">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            {{-- route('string') => con esta función hacemos referencia al Alias de la ruta --}}
            {{-- novalidate => Deshabilita la validación de HTML5 --}}
            <form action="{{ route('register') }}" method="POST" novalidate>
                {{-- @csrf => Se utiliza esta función para generar un hash de seguridad que se utilizará para cada petición que se realice --}}
                @csrf
                <div class="mb-3">
                    <label for="name" class="mb-1 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Tu Nombre"
                    class="border p-2 w-full rounded-lg @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}">

                    @error('name')
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
