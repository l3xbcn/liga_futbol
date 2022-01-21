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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect(request()->getSchemeAndHttpHost().'/player' );
});


Route::post('game/store', [GameController::class, 'store']);
Route::put('game/update', [GameController::class, 'update']);
Route::delete('game/destroy/{game}', [GameController::class, 'destroy']);
Route::resource('game', GameController::class)->names('game');

Route::post('player/store', [PlayerController::class, 'store']);
Route::put('player/update', [PlayerController::class, 'update']);
Route::delete('player/destroy', [PlayerController::class, 'destroy']);
Route::resource('player', PlayerController::class)->names('player');

Route::get('team/{team}/players', [PlayerController::class, 'players'])->name('team.players');
Route::post('team/store', [TeamController::class, 'store']);
Route::put('team/update', [TeamController::class, 'update']);
Route::delete('team/destroy', [TeamController::class, 'destroy']);
Route::resource('team', TeamController::class)->names('team');

Route::resource('edition', EditionController::class)->names('edition');

Route::get('user', [UserController::class, 'index'])->middleware('can:edit')->name('user.index');
Route::get('user/{user}', [UserController::class, 'show'])->middleware('can:admin')->name('user.show');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->middleware('can:admin')->name('user.edit');
Route::post('user/store', [UserController::class, 'store'])->middleware('can:admin')->name('user.store');
Route::put('user/update', [UserController::class, 'update'])->middleware('can:admin')->name('user.update');
Route::delete('user/destroy', [UserController::class, 'destroy'])->middleware('can:admin')->name('user.destroy');

// Casos especiales, para que el botón de Crear registro funcione en cualquier vista
Route::get('player/{player}/create', [PlayerController::class, 'create'])->name('player.player_id.create');
Route::get('team/{team}/create', [TeamController::class, 'create'])->name('team.team.create');
Route::get('team/{team}/players/create', [PlayerController::class, 'create'])->name('team.team_id.players.create');

Route::get('/404', function () {
    return abort(404);
})->name('404');