<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //Por convención los controladores deben tener un método llamado "index" cuando este tenga solo 1 método
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd() => Esta función sirve para imprimir en pantalla los datos que se le pasan como parámetro y se detiene la ejecución del programa.
        // $request => Esta variable contiene todos los datos que se envían desde el formulario de registro.
        // dd($request);


        // $request->get('string') => Esta función sirve para obtener uno de los datos que se envían desde el formulario de registro.
        // dd($request->get('username'));

        // Modificación del Request
        //$request->request->add() => Esta función sobreescribe el valor del campo que se le pasa como parámetro.
        $request->request->add(["username" => Str::slug( $request->username )]);

        // $this->validate(Instancia del "Request", Array con las reglas de validación) => Esta función sirve para validar los datos que se envían desde el formulario de registro.
        $this->validate($request, [
            'name' => 'required|max:30', // El nombre es requerido y no puede tener más de 30 caracteres.
            'username' => 'required|unique:users|min:3|max:20', // El nombre de usuario es requerido y debe ser único, no puede tener menos de 3 caracteres y no puede tener más de 20 caracteres.
            'email' => 'required|unique:users|email|max:60', // El email es requerido y debe ser único, debe ser un email válido y no puede tener más de 60 caracteres.
            'password' => 'required|confirmed|min:6', // El password es requerido y debe tener más de 6 caracteres.
        ]);


        // Hacemos uso del ORM Eloquent para crear un nuevo registro en la tabla "users"
        // User::create => Esta función es el equivalente a "INSERT INTO users (name, username, email, password) VALUES (...)".
        User::create([
            'name' => $request->name,
            'username' => $request->username, // Para no obtener error al hacer el INSERT del campo "username" se debe agregar entre los campos protegidos en el archivo "app\Models\User.php".
            'email' => $request->email,
            'password' => Hash::make( $request->password ) // El password se encripta con la función "Hash::make()" de Laravel.
        ]);

        // auth() => Este helper (función de ayuda) sirve para obtener el objeto de autenticación de Laravel.
        // auth()->attempt() => Esta función sirve para autenticar al usuario.
        //                      Recibe como parametro un array con los datos del usuario y un  booleano (Opcional) que indica si se debe recordar al usuario,
        //                      Por defecto el valor es "False".

        // Forma Extendida de Autenticar un Usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Forma Corta de Autenticar un Usuario
        auth()->attempt($request->only('email', 'password'));


        return redirect()->route('post.index');
    }
}
