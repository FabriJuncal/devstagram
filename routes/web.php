<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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

Route::get('/', function () {
    return view('principal');
});

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

Route::get('/muro', [PostController::class, 'index'])->name('post.index');
