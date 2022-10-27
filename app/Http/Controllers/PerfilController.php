<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

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

        // ADVERTINCIA: no agregar espacios entre cada elementos del array de reglas de validación.
        $this->validate($request, [
            'username' => [
                            'required',
                            'unique:users,username,'.auth()->user()->id, // Esta validación se hace para que el usuario no pueda cambiar su nombre de usuario a uno que ya existe, pero si puede ingresar su propio nombre de usuario que ya existe.
                            'min:3',
                            'max:20',
                            'not_in:twitter,editar-perfil' // Esta validación se hace para que el usuario no pueda cambiar su nombre de usuario a uno que se encuentre dentro de los no permitidos.
                          //'in: twitter, editar-perfil' // Esta validación se hace para que el usuario solo pueda agregar los valores permitidos.
                        ], // El nombre de usuario es requerido y debe ser único, no puede tener menos de 3 caracteres y no puede tener más de 20 caracteres.
            'email' => ['required','unique:users,email,'.auth()->user()->id,'email','max:60'], // El email es requerido y debe ser único, debe ser un email válido y no puede tener más de 60 caracteres.
        ]);


        if($request->hasFile('imagen')){
            // Obtenemos los datos del archivo que se subió
            $imagen = $request->file('imagen');

            // Creamos un nombre aleatorio para el archivo
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // Pasamos como parametro la imagen que se quiere subír a la función de Intervention.io
            // De esta forma vamos a poder manipular la imagen antes de subirla al servidor
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000, null, 'center'); // Redimensionamos la imagen a 1000x1000px y definimos que corte en el centro

            // Validamos si existe el directorio
            if(!file_exists(public_path('perfiles'))){
                // Si no existe creamos el directorio
                mkdir(public_path('perfiles'), 0777, true);
            }

            // Definimos la ruta donde vamos a almacenar la imagen
            $imagenPath = public_path('perfiles/' . $nombreImagen);
            // Guardamos la imagen en la ruta definida
            $imagenServidor->save($imagenPath);
        }

        // Guardar Cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Cambiar la contraseña

        if($request->password_antiguo || $request->password || $request->password_confirmation){
            // dd($request);
            $this->validate($request, [
                'password_antiguo' => 'required|min:6',
                'password' => 'required|confirmed|min:6'
            ]);

            if(Hash::check($request->password_antiguo, $usuario->password)){
                $usuario->password = Hash::make($request->password);
                $usuario->save();
            } else {
                // Redirecciona al formularió de edición de perfil con un mensaje de error.
                return back()->with('mensaje', 'La contraseña antigüa no coincide.');
            }

        }

        // Redirecciona al perfil del usuario con un mensaje de éxito.
        return redirect()->route('post.index', $request->username);

    }
}
