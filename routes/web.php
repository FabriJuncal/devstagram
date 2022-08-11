<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Al tener el método __invoke en la classe HomeController, podemos hacer uso de esta sintaxis, ya que siempre se va a ejecutar el método __invoke
Route::get('/', HomeController::class)->name('home');

// ->name('string'): Esta función se utiliza para agregarle un Alias a la ruta,
// de esta manera se podrá hacer referencia a la ruta nombrando el Alias en la cantida
// de lugares que se desea y si se tiene que cambiar el nombre de la ruta se evita tener que modificar
// en muchos lugares, solo basta con cambiar el nombre de la ruta en este unico lugar.
// Tambien hay que tener encuenta que el Alias puede ser aplicado a rutas iguales con distinto método (GET, POST, PUT, DELETE)
// solo se tiene que agregar el Alias a la primera ruta y debajo agregar toda la rutas iguales pero con distinto método.

Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Controladores que se encargan de gestionar el perfil del usuario
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Controlador que se encarga de agregar el comentario en la publicación
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

// Controlador que se encarga de subir las imagenes al servidor
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');


//========================================================================================================================================//
/** Siempre colocar las rutas con variables por ultimo, ya que de este modo se asegura de que primero se ingrese a las variables fijas **/

// Esta caracteristica de enviar parametros por medio de la URL y filtrar información obtenida de la base de datos se denomina Router Model Binding
// Esta caracteristica se utiliza para que el controlador pueda obtener los datos de la base de datos a través de una ruta con un parametro
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
// Pasamos dos parametros por medio del Router Model Binding
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Siguiendo a Usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
// Dejando de seguir a Usuarios
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

// Controlador que se encarga de eliminar una publicación
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// Controlador que se encargará de registrar los likes de los Posts
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
// Controlador que se encargará de eliminar los likes de los Posts
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');
