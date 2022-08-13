{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')

    {{-- Componente de Laravel: --}}
    {{-- Todos los componentes de laravel comienzan con "x-" --}}
    {{-- Los componentes que no vayan a recibír parametros deben ser de una sola etiqueta y deben cerrarse con "/>" --}}
    <x-listar-post/>

    {{-- A los componentes de Laravel se le pueden pasar parametros de las siguientes maneras: --}}
    {{-- Forma 1 --}}
    {{-- <h1> => No definimos nombre del Slot (Parametro que se envía al componente) por lo general este parametro hace referencia al nombre $slot dentro del componente--}}
    {{-- <x-listar-post>
        <h1>Mostrando post desde Slot</h1>
    </x-listar-post> --}}

    {{-- Forma 2 --}}
    {{-- <x-slot:titulo> => Definimos el Nombre del Slot (Parametro que se envía al componente) --}}
    {{-- <h1> => No definimos nombre del Slot (Parametro que se envía al componente) por lo general este parametro hace referencia al nombre $slot dentro del componente--}}
    {{-- <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>
        <h1>Mostrando post desde Slot</h1>
    </x-listar-post> --}}



@endsection
