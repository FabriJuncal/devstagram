@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/3 bg-white shadow p-6">
            <form action="" class="mt-10 md:mt-0">
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

                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3  text-white rounded-lg">
            </form>
        </div>
    </div>

@endsection
