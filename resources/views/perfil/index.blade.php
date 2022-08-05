@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/3 bg-white shadow p-6">
            {{-- enctype => Modifica el body de la petició para indicar el tipo de información se enviará.
             "multipart/form-data" =>  Se utiliza cuando en la petición se envía información por el campo <input type="file"> --}}
            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-1 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class="border p-2 w-full rounded-lg @error('username') border-red-500 @enderror"
                    value="{{ auth()->user()->username }}">

                    @error('username')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-1 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Tu Email"
                    class="border p-2 w-full rounded-lg  @error('email') border-red-500 @enderror"
                    value="{{ auth()->user()->email }}">

                    @error('email')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-1 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input
                    id="imagen"
                    name="imagen"
                    type="file"
                    class="border p-2 w-full rounded-lg"
                    value=""
                    accept=".jpg, .jpeg, .png">
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-1 block uppercase text-gray-500 font-bold">
                        Password Antigüo
                    </label>
                    <input
                    id="password_antiguo"
                    name="password_antiguo"
                    type="password_antiguo"
                    placeholder="Tu Antigüo Password"
                    class="border p-2 w-full rounded-lg @error('password_antiguo') border-red-500 @enderror @if(session('mensaje')) border-red-500 @endif">

                    @error('password_antiguo')
                        <span class="text-red-500 text-xs Helvetica">
                            * {{ $message }}
                        </span>
                    @enderror
                    {{-- session('mensaje') => es una forma de obtener una variable que lo obtenemos desde los Controladores al realizar una redireccion--}}
                    @if(session('mensaje'))
                        <div class="text-red-500 text-xs Helvetica">
                            * {{ session('mensaje') }}
                        </div>
                    @endif
                </div>
                <div class="mb-5">
                    {{-- En el campo "Repetir Password" se agregá "_confirmation" en los siguientes atributos
                         para que lo detecte laravel y haga uso de la función para detectar que los password sean iguales--}}
                    <label for="password" class="mb-1 block uppercase text-gray-500 font-bold">
                        Nuevo Password
                    </label>
                    <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Tu Nuevo Password"
                    class="border p-2 w-full rounded-lg @error('password') border-red-500 @enderror">
                </div>
                <div class="mb-5">
                    {{-- En el campo "Repetir Password" se agregá "_confirmation" en los siguientes atributos
                         para que lo detecte laravel y haga uso de la función para detectar que los password sean iguales--}}
                    <label for="password_confirmation" class="mb-1 block uppercase text-gray-500 font-bold">
                        Repetir Nuevo Password
                    </label>
                    <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repite tu Password"
                    class="border p-2 w-full rounded-lg @error('password') border-red-500 @enderror">
                </div>

                @error('password')
                    <span class="text-red-500 text-xs Helvetica">
                        * {{ $message }}
                    </span>
                @enderror

                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 mt-3 text-white rounded-lg">
            </form>
        </div>
    </div>

@endsection
