{{-- @extends() => Importa los Layout a utilizar --}}
@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <img src="{{
                     $user->imagen ?
                     asset('perfiles') . '/' . $user->imagen :
                     asset('img/usuario.svg') }}"
                     alt="imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl"> {{ $user->username }} </p>
                    {{-- Directiva que detecta si el usuario se encuentra Logeado y muestra lo que tenga dentro --}}
                    @auth
                        {{-- Se valida que el usuario logeado sea el mismo que el del perfil --}}
                        @if($user->id === auth()->user()->id)
                            <a  href="{{ route('perfil.index') }}"
                                class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{-- Muestra la Cantidad de Seguidores que tiene el Usuario--}}
                    {{ $user->followers->count() }}
                    {{-- @choice() => Según el valor numero que se le pase como 2do Parametro, este identificará si debe mostrar el String 1 o 2 que se le pase como 1er Parametro  --}}
                    <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count()) </span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{-- Muestra la Cantidad de Usuarios Seguidos que tiene el Usuario--}}
                    {{ $user->followings->count() }}
                    <span class="font-normal"> Siguiendo </span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{-- Muestra la Cantidad de Post del Usuario --}}
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                {{-- Solo los usuarios Autenticados podran ver los botones --}}
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if( !$user->siguiendo( auth()->user() ))

                            <form
                                action="{{ route('users.follow', $user)}}"
                                method="POST"
                            >
                                @csrf
                                <input
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                    value="Seguir"
                                />

                                {{-- <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                    Seguir
                                </button> --}}
                            </form>

                        @else

                            <form
                            action="{{ route('users.unfollow', $user)}}"
                            method="POST"
                            >
                                @csrf
                                @method('DELETE')
                                {{-- <input
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                    value="Dejar de Seguir"
                                /> --}}

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                    Dejar de Seguir
                                </button>
                            </form>

                        @endif
                    @endif
            @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if($posts->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($posts as $post)
                    <div>
                        {{-- Enviamos dos parametros al Router Model Binding --}}
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="my-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
    </section>

@endsection
