<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarPost extends Component
{

    // Se debe definir el atributo del componente para que se pueda acceder a él desde la vista
    // Este debe llamarse igual al atributo del componente de la vista, en este caso se pasó:
    // <x-listar-post :posts="$posts"/>
    public $posts;

    // Desde el constructor debemos pasar el parámetro que se va a mostrar en la vista
    // Este tomará el parametro que se le pase desde la vista donde se esta llamando al componente
    // en este caso se le pasó <x-listar-post :posts="$posts"/>
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    // Método que renderiza la vista del componente
    public function render()
    {
        return view('components.listar-post');
    }
}
