<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Se debe definir el atributo del componente para que se pueda acceder a él desde la vista
    // Este debe llamarse igual al atributo del componente de la vista, en este caso se pasó:
    // <livewire:like-post :post="$post"/>
    public $post;

    // Atributo que se usa para saber si el usuario ya ha dado like al post
    public $isLiked;

    // mount() es un método que se ejecuta automáticamente cuando el componente se carga,
    // vendría a ser como el constructor del componente, donde este se ejecuta cuando se instancía o se carga el componente.
    public function mount()
    {
        $this->isLiked = $this->post->checkLike(auth()->user());
    }


    // Método que se ejecuta cuando se hace click en el botón de like
    // Este método se encargará de realizar la acción de like o dislike
    public function like()
    {
        // Verifica si el usuario ya ha dado like al post
        if( $this->post->checkLike(auth()->user()) ) {
            // Si ya ha dado like al post, entonces se elimina el like
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
        } else {
            // Si no ha dado like al post, entonces se crea un nuevo like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
        }


    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
