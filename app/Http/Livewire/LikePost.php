<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Se debe definir el atributo del componente para que se pueda acceder a él desde la vista
    // Este debe llamarse igual al atributo del componente de la vista, en este caso se pasó:
    // <livewire:like-post :post="$post"/>
    public $post;

    // Método que se ejecuta cuando se hace click en el botón de like
    // Este método se encargará de realizar la acción de like o dislike
    public function like()
    {
        // Verifica si el usuario ya ha dado like al post
        if( $this->post->checkLike(auth()->user()) ) {
            // Si ya ha dado like al post, entonces se elimina el like
            $this->post->likes()->where('post_id', $this->post->id)->delete();
        } else {
            // Si no ha dado like al post, entonces se crea un nuevo like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
        }


    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
