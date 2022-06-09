<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <h1 class="text-3xl font-black">
                    DevStagram
                </h1>

                {{-- Directiva que detecta si el usuario se encuentra Logeado y muestra lo que tenga dentro --}}
                @auth
                    <nav>
                        <a class="font-bold text-gray-600" href="{{ route('login') }}">
                            Hola:
                            <span class="font-normal">
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        {{-- route('string') => con esta función hacemos referencia al Alias de la ruta --}}
                        <a class="font-bold uppercase text-gray-600" href="{{ route('logout') }}">Cerrar Sesión</a>
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
