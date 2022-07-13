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
        2
    </div>
</div>

@endsection
