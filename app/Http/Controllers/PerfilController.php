<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PerfilController extends Controller
{
    // __construct() => Es un método constructor de la clase, es decir, se ejecuta siempre que se crea una nueva instancia de la clase.
    public function __construct()
    {
        // $this->middleware('auth'):
        // Valida que haya un Usuario Autenticado, de esta manera protegemos la ruta en el cual se requiere que el usuario se encuentre logeado
        // Por defecto redirecciona a la ruta "login", por lo tanto hay que crear esta vista en la carpeta "resources/views/auth"
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Modificación del Request
        //$request->request->add() => Esta función sobreescribe el valor del campo que se le pasa como parámetro.
        $request->request->add(["username" => Str::slug( $request->username )]);

        // $this->validate(Instancia del "Request", Array con las reglas de validación) => Esta función sirve para validar los datos que se envían desde el formulario de registro.
        // Sugerencia => Laravel suguiere que cuando un campo contenga mas de 3 reglas de validación, estos deben ir dentro de un corchete.
        //               Como el campo "username" por ejemplo.
        $this->validate($request, [
            'username' => [
                            'required',
                            'unique:users, username, '.auth()->user()->id, // Esta validación se hace para que el usuario no pueda cambiar su nombre de usuario a uno que ya existe, pero si puede ingresar su propio nombre de usuario que ya existe.
                            'min:3',
                            'max:20',
                            'not_in: twitter, editar-perfil' // Esta validación se hace para que el usuario no pueda cambiar su nombre de usuario a uno que se encuentre dentro de los no permitidos.
                          //'in: twitter, editar-perfil' // Esta validación se hace para que el usuario solo pueda agregar los valores permitidos.
                        ], // El nombre de usuario es requerido y debe ser único, no puede tener menos de 3 caracteres y no puede tener más de 20 caracteres.
        ]);
    }
}
