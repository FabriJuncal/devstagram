<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Se debe definir el atributo del componente para que se pueda acceder a él desde la vista
    // Este debe llamarse igual al atributo del componente de la vista, en este caso se pasó:
    // <livewire:like-post :post="$post"/>
    public $post;

    public function render()
    {
        return view('livewire.like-post');
    }
}
