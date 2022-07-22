<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth'):
        // Valida que haya un Usuario Autenticado, de esta manera protegemos la ruta en el cual se requiere que el usuario se encuentre logeado
        // Por defecto redirecciona a la ruta "login", por lo tanto hay que crear esta vista en la carpeta "resources/views/auth"

       // ->except(['show', 'index']): Función que permite hacer excepciones a las rutas que se desean excluir de la validación de autenticación.
       // En este caso, la ruta "show" y "index" no requieren de autenticación y el usuario podrá visualizar la publicación sin estar logeado.
       // Parametro -> Array con los nombres de los métodos que se desean excluir de la validación de autenticación.
        $this->middleware('auth')->except(['show', 'index']);
    }

    // Instanciamos de la clase "User" y lo pasamos como parametro al método
    public function index(User $user)
    {

        // Obtenemos todos los registros de la tabla "posts" Filtrado por el ID del Usuario Autenticado
        $posts = Post::where('user_id', $user->id)->paginate(8);

        // auth()->user() => Esta función sirve para obtener el objeto de autenticación de Laravel.
        //                   Este muestra los datos del usuario que se encuentra autenticado.
        // dd(auth()->user());

        // View() => Esta función sirve para redireccionar a una vistal.
        // 1er Parametro => Nombre de la vista
        // 2do Parametro => Arreglo con los datos que se le pasan a la vista
        // compact('user') => Esta función sirve para crear un arreglo con el Key y Value iguales, es decir, es el equivalente de [user => $user, posts => $posts]
        return view('dashboard', compact('user', 'posts'));
    }

    // La función "create" siempre se encargará de mostrar mediante un GET, la vista "create" donde estará el formulario de ALTA
    public function create()
    {
        return view('posts.create');
    }

    // La función "store" siempre se ejecutará mediante una petición POST, este se encargará de Validat Guardar los datos en la base de datos
    public function store(Request $request)
    {

        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required', //
        ]);

        // Forma 1:
        // create => Es una función del modelo "Post" que era los métodos de la clase "Model" en donde esta función se encarga de insertar un nuevo registro en la base de datos
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        // // Forma 2:
        // // Instanciamos la clase "Post" que era los métodos de la clase "Model"
        // $post = new Post;
        // // Asignamos los valores a los atributos del modelo
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // // Guardamos el registro en la base de datos
        // $post->save();

        // Forma 3:
        // $request->user()->posts() => Hacemos referencia a la relación entre el modelo "User" y el modelo "Posts"
        // create() => Función equivalente al INSERT
        //  -> Parametro => Array con los respectivos nombres de los campos y los valores que se insertarán
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);



        return redirect()->route('post.index', auth()->user()->username);
    }

    //La función "show" se encargará de mostrar mediante un GET, la vista "show" donde estará la información del registro que seleccionemos
    public function show(User $user, Post $post)
    {
        // Enviamos dos parametros a la vista
        return view('posts.show', compact('user', 'post'));
    }

    // La función "destroy" se encargará de eliminar un registro de la base de datos.
    public function destroy(Post $post)
    {
        // Validamos con POLICY que el Usuario que creó la Publicación sea el mismo que el usuario que quiere eliminarlo.
        $this->authorize('delete', $post);
        // Eliminamos el registro de la base de datos
        $post->delete();

        // Eliminamos la imagen fisica del servidor
        $imagen_path = public_path('uploads/' . $post->imagen);

        // File::exists() => Función que permite verificar si el archivo existe en el servidor.
        // Parametro => Ruta del archivo que se desea verificar.
        if(File::exists($imagen_path)) {
            // unlink() => Función que permite eliminar un archivo fisico del servidor.
            // Parametro => Ruta del archivo que se desea eliminar.
            unlink($imagen_path);
        }

        // Redireccionamos a la ruta "post.index", y enviamós el usuario autenticado como parametro
        return redirect()->route('post.index', auth()->user()->username);
    }
}
