<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;

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
    return redirect(request()->getSchemeAndHttpHost().'/jugador' );
});

Route::post('jugador/store', [JugadorController::class, 'store']);
Route::put('jugador/update', [JugadorController::class, 'update']);
Route::delete('jugador/destroy', [JugadorController::class, 'destroy']);
Route::resource('jugador', JugadorController::class);
