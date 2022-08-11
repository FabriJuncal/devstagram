<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- @stack('styles') => Directiva que se utiliza para reservar este espacio, en donde luego podemos hacer referencia a este con la directiva "@push('styles')"
                                 y asignarle una importación.
                                 Puede ser una importación de Estilos CSS como así tambien de JavaScript.
        @stack([PARAMETRO]) => Como parametro recibe un string que se definirá como el nombre de esta directiva. --}}
        @stack('styles')
        {{-- asset() => Hace dinamica las ruta cuando se compila en el directorio "public" --}}
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        {{-- @yield() => Contenedor que reserva el lugar para el texto u código html que pasemos como parametro --}}
        <title>DevStagram - @yield('titulo')</title>
        {{-- defer => Atributo que indica que no se ejecutará el script hasta que la página se haya cargado --}}
        <script src="{{ asset('js/app.js')}}" defer></script>
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-3xl font-black">
                    DevStagram
                </a>

                {{-- Directiva que detecta si el usuario se encuentra Logeado y muestra lo que tenga dentro --}}
                @auth
                    <nav class="flex gap-2 items-center">

                        <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                        href="{{ route('posts.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Crear
                        </a>

                        <a class="font-bold text-gray-600" href="{{ route('post.index', auth()->user()->username) }}">
                            Hola:
                            <span class="font-normal">
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        {{-- Creamos un "form" para cerrar la sesión, así de este modo se realiza una petición POST y podemos utilizar la directiva "@csrf" para tener mas seguridad --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                                Cerrar Sesión
                            </button>
                        </form>

                    </nav>
                @endauth

                {{-- Directiva que detecta si el usuario NO se encuentra Logeado y muestra lo que tenga dentro --}}
                @guest
                    <nav>
                        <a class="font-bold uppercase text-gray-600" href="{{ route('login') }}">Login</a>
                        {{-- route('string') => con esta función hacemos referencia al Alias de la ruta --}}
                        <a class="font-bold uppercase text-gray-600" href="{{ route('register') }}">Crear Cuenta</a>
                    </nav>
                @endguest


            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        <footer class="text-center p-5 text-gray-500 font-bold">
            {{-- now(): Helper de Laravel para mostrar la fecha actual --}}
            DevStagram - Todos los derechos reservados {{ now()->year }}
        </footer>
    </body>
</html>
