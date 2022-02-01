<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\UserController;

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

Route::get('/', [PlayerController::class, 'index'])->name('home');

// Los usuarios registrados sólo pueden ver los jugadores y equipos
// Los registrados con el rol por defecto de Viewer (permiso view) pueden ver adenás los resultados de los partidos
// Los usuarios con permiso de edición pueden ver, crear, editar y eliminar jugadores, partidos y resultados
// Los administradores además pueden ver, crear, editar y eliminar usuarios
Route::post('game/store', [GameController::class, 'store'])->middleware('can:edit')->name('game.store');
Route::get('game/create', [GameController::class, 'create'])->middleware('can:edit')->name('game.create');
Route::get('game', [GameController::class, 'index'])->middleware('can:view')->name('game.index');
Route::get('game/{game}', [GameController::class, 'show'])->middleware('can:view')->name('game.show');
Route::get('game/{game}/edit', [GameController::class, 'edit'])->middleware('can:edit')->name('game.edit');
Route::put('game/{game}', [GameController::class, 'update'])->middleware('can:edit')->name('game.update');
Route::delete('game/{game}', [GameController::class, 'destroy'])->middleware('can:edit')->name('game.destroy');

Route::post('player/store', [PlayerController::class, 'store'])->middleware('can:edit')->name('player.store');
Route::get('player/create', [PlayerController::class, 'create'])->middleware('can:edit')->name('player.create');
Route::get('player', [PlayerController::class, 'index'])->name('player.index');
Route::get('player/{player}', [PlayerController::class, 'show'])->name('player.show');
Route::get('player/{player}/edit', [PlayerController::class, 'edit'])->middleware('can:edit')->name('player.edit');
Route::put('player/{player}', [PlayerController::class, 'update'])->middleware('can:edit')->name('player.update');
Route::delete('player/{player}', [PlayerController::class, 'destroy'])->middleware('can:edit')->name('player.destroy');

Route::post('team/store', [TeamController::class, 'store'])->middleware('can:edit')->name('team.store');
Route::get('team/create', [TeamController::class, 'create'])->middleware('can:edit')->name('team.create');
Route::get('team', [TeamController::class, 'index'])->name('team.index');
Route::get('team/{team}', [TeamController::class, 'show'])->name('team.show');
Route::get('team/{team}/edit', [TeamController::class, 'edit'])->middleware('can:edit')->name('team.edit');
Route::put('team/{team}', [TeamController::class, 'update'])->middleware('can:edit')->name('team.update');
Route::delete('team/{team}', [TeamController::class, 'destroy'])->middleware('can:edit')->name('team.destroy');

Route::get('team/{team}/players', [PlayerController::class, 'players'])->name('team.players');

Route::get('user/create', [UserController::class, 'create'])->middleware('can:admin')->name('user.create');
Route::post('user/store', [UserController::class, 'store'])->middleware('can:admin')->name('user.store');
Route::get('user', [UserController::class, 'index'])->middleware('can:admin')->name('user.index');
Route::get('user/{user}', [UserController::class, 'show'])->middleware('can:admin')->name('user.show');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->middleware('can:admin')->name('user.edit');
Route::put('user/update', [UserController::class, 'update'])->middleware('can:admin')->name('user.update');
Route::delete('user/destroy', [UserController::class, 'destroy'])->middleware('can:admin')->name('user.destroy');

Route::resource('edition', EditionController::class)->names('edition');

Route::get('/404', function () {
    return abort(404);
})->name('404');

require __DIR__.'/auth.php';

Route::fallback(function () {
    return view("404");
});
