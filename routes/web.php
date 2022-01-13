<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\UserController;
use App\Models\Jugador;
use App\Models\User;

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
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect(request()->getSchemeAndHttpHost().'/jugador' );
});

Route::post('jugador/store', [JugadorController::class, 'store']);
Route::put('jugador/update', [JugadorController::class, 'update']);
Route::delete('jugador/destroy', [JugadorController::class, 'destroy']);
Route::resource('jugador', JugadorController::class)->names('jugador');

Route::get('user', [UserController::class, 'index'])->middleware('can:edit');
Route::get('user/{user}', [UserController::class, 'show'])->middleware('can:admin');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->middleware('can:admin');
Route::post('user/store', [UserController::class, 'store'])->middleware('can:admin');
Route::put('user/update', [UserController::class, 'update'])->middleware('can:admin');
Route::delete('user/destroy', [UserController::class, 'destroy'])->middleware('can:admin');
