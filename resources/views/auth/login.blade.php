{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center text-sm">
        <div class="md:w-6/12 max-w-2xl">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            {{-- route('string') => con esta función hacemos referencia al Alias de la ruta --}}
            {{-- novalidate => Deshabilita la validación de HTML5 --}}
            <form  action="{{ route('login') }}" method="POST" novalidate>
                {{-- @csrf => Se utiliza esta función para generar un hash de seguridad que se utilizará para cada petición que se realice --}}
                @csrf

                {{-- Valida que el campo "mensaje" de la session contenga algún valor. --}}
                {{-- En el caso que contenga algún valor, este imprime el mensaje en pantalla. --}}
                {{-- session('mensaje') => es una forma de obtener una variable que lo obtenemos desde los Controladores al realizar una redireccion--}}
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <div class="mb-3">
                    <label for="email" class="mb-1 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Tu Email de Registro"
                    class="border p-2 w-full rounded-lg  @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">

                    @error('email')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="mb-1 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password de Registro"
                    class="border p-2 w-full rounded-lg @error('password') border-red-500 @enderror">

                    @error('password')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Checkbox que ejecutá función para mantener la sesión abierta --}}
                <div class="mb-5">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="text-gray-500 text-sm">
                        Mantener mi sesión abierta
                    </label>
                </div>

                <input
                    type="submit"
                    value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3  text-white rounded-lg">
            </form>
        </div>
    </div>



@endsection
