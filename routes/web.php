<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
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


Route::get('/community', [App\Http\Controllers\CommunityLinkController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('community');;
Route::post('/community', [App\Http\Controllers\CommunityLinkController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('community');;

Route::get('/Respuesta', function () {
    return response('Respuesta', 200);
});

Route::get('/error', function () {
    return response('Error', 404);
});


Route::get('community/{channel}', [App\Http\Controllers\CommunityLinkController::class, 'index'])->middleware(['auth', 'verified'])->name('community');

Route::post('/community/votes/{link}', [App\Http\Controllers\CommunityLinkUserController::class, 'store'])->middleware(['auth', 'verified'])->name('community');

// Route::get('/consultas', function () {
//     return DB::table('users')->where('id',3)->delete();
// });


require __DIR__ . '/auth.php';
