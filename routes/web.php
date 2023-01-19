<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
 })->middleware(['auth', 'verified'])->name('dashboard');
 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store']);

// 1) Crea una ruta que tenga un parámetro que sea opcional y comprueba que funciona
Route::get('/community/{nombre?}', function ($nombre) {
    return "Mi nombre es $nombre";
});

// Crea una ruta que tenga un parámetro que sea opcional y tenga un valor por defecto en caso de que no se especifique.
Route::get('/ruta/{nombre?}', function ($nombre = "No has introducido ningún nombre") {
    return $nombre;
});

// Crea una ruta que atienda por POST y compruébala con Postman.
Route::post('/rutilla', function () {
    $name = $_POST['name'];
    return $name;
});

//Crea una ruta que atienda por GET y por POST (en un único método) y compruébalas.

Route::match(['get', 'post'], '/rutikele', function ($apellido = "glez") {
    return $apellido;

});

// Crea una ruta que compruebe que un parámetro está formado sólo por números.



//Crea una ruta con dos parámetros que compruebe que el primero está formado sólo por letras y el segundo sólo por números.

// 2) Utiliza el helper env para que cuando se acceda a la ruta /host nos devuelva la dirección IP donde se encuentra la base de datos de nuestro proyecto.

Route::get('/host', function () {
    $host = env('DB_HOST');

    return $host;
});

// Utiliza el helper config para que cuando se acceda a la ruta /timezone se muestre la zona horaria.
// Está dentro del archivo app.php en la línea 72

Route::get('/timezone', function(){
    $time = config('app.timezone');

    return $time;
});

Route::view('/inicio', 'home');

// Route::view('/fecha', 'fecha', ['day' => date("d"), 'month' => date("F"), 'year' => date("Y")]);

// helper with
Route::get('/fecha1', function () {
    return view('fecha')->with('day', date("d"))->with('month', date("F"))->with('year', date("Y"));
});

// Route::view('/image', '404', function (){
//     $url = asset('images/404.webp');
//     return $url;
// });

Route::view('/image', '404');


require __DIR__.'/auth.php';
