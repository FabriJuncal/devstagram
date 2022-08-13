{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')

    {{-- Componente de Laravel: --}}
    {{-- Todos los componentes de laravel comienzan con "x-" --}}
    <x-listar-post/>

@endsection
