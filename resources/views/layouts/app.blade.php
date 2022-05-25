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

        <h1 class="text-5xl font-black">@yield('titulo')</h1>

    </body>
</html>
