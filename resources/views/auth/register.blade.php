{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Regístrate en DevStagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center text-sm">
        <div class="md:w-6/12 max-w-2xl">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            {{-- route('string') => con esta función hacemos referencia al Alias de la ruta --}}
            <form action="{{ route('register') }}" method="POST">
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
                    class="border p-2 w-full rounded-lg"
                    value="{{ old('name') }}">

                    @error('name')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="mb-1 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class="border p-2 w-full rounded-lg">
                </div>
                <div class="mb-3">
                    <label for="email" class="mb-1 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                    id="email"
                    name="email"
                    type="text"
                    placeholder="Tu Email de Registro"
                    class="border p-2 w-full rounded-lg">
                </div>
                <div class="mb-3">
                    <label for="password" class="mb-1 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                    id="password"
                    name="password"
                    type="text"
                    placeholder="Password de Registro"
                    class="border p-2 w-full rounded-lg">
                </div>
                <div class="mb-3">
                    {{-- En el campo "Repetir Password" se agregá "_confirmation" en los siguientes atributos
                         para que lo detecte laravel y haga uso de la función para detectar que los password sean iguales--}}
                    <label for="password_confirmation" class="mb-1 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="text"
                    placeholder="Repite tu Password"
                    class="border p-2 w-full rounded-lg">
                </div>

                <input
                    type="submit"
                    value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3  text-white rounded-lg">
            </form>
        </div>
    </div>



@endsection
