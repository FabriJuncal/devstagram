<div>
    {{-- <x-slot:titulo> => Definimos el Nombre del Slot (Parametro que se envía al componente) --}}
    {{-- {{ $titulo }} --}}
    {{-- <h1> => No definimos nombre del Slot (Parametro que se envía al componente) por lo general este parametro hace referencia al nombre $slot dentro del componente--}}
    {{-- {{ $slot }} --}}

    {{-- @forelse => es una mescla entre un IF y un FOREACH, en donde si el array obtenido como parametro contiene algo va a iterarlo, si este esta vacio va a ejecutar el HTML denctro de @empty --}}
    {{-- @forelse ($posts as $post)
        <h1>{{ $post->titulo }}</h1>
    @empty
        <p>No hay posts</p>
    @endforelse --}}

    {{-- Se utilizará @if ya que se tiene mas control sobre este al agregar código HTML --}}
    @if($posts->count())

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

    @foreach ($posts as $post)
        <div>
            {{-- Enviamos dos parametros al Router Model Binding --}}
            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            </a>
        </div>
    @endforeach

    <div class="my-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>

    @else
    <p class="text-gray-600 uppercase text-sm text-center font-bold">
        No hay Posts, sigue a alguien para poder mostrar sus posts
    </p>
    @endif
</div>
