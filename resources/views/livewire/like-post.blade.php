{{-- ADVERTENCIA: Un componente de Livewire siempre debe tener un "<div>" como contenedor padre para que funcione --}}
<div>
    {{-- wire:click => define el evento que ejecutará con Livewire --}}
    {{-- "like" => Nombre de la función en el archivo de lógica en "app\Http\Livewire\LikePost.php" que se ejecutará cuando se realice el evento --}}
    <button wire:click="like">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="{{ $isLiked ? 'red' : 'white' }}" }}"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
    </button>
</div>
