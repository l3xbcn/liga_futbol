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

Route::get('game', [GameController::class, 'index'])->name('game.index');
Route::get('game/{game}', [GameController::class, 'show'])->name('game.show');
Route::get('game/{game}/edit', [GameController::class, 'edit'])->middleware('can:edit')->name('game.edit');
Route::get('game/create', [GameController::class, 'create'])->middleware('can:edit')->name('game.create');
Route::post('game/store', [GameController::class, 'store'])->middleware('can:edit')->name('game.store');
Route::put('game/update', [GameController::class, 'update'])->middleware('can:edit')->name('game.update');
Route::delete('game/destroy', [GameController::class, 'destroy'])->middleware('can:edit')->name('game.destroy');

Route::get('player', [PlayerController::class, 'index'])->name('player.index');
Route::get('player/{player}', [PlayerController::class, 'show'])->name('player.show');
Route::get('player/{player}/edit', [PlayerController::class, 'edit'])->middleware('can:edit')->name('player.edit');
Route::get('player/create', [PlayerController::class, 'create'])->middleware('can:edit')->name('player.create');
Route::post('player/store', [PlayerController::class, 'store'])->middleware('can:edit')->name('player.store');
Route::put('player/update', [PlayerController::class, 'update'])->middleware('can:edit')->name('player.update');
Route::delete('player/destroy', [PlayerController::class, 'destroy'])->middleware('can:edit')->name('player.destroy');

Route::get('team', [TeamController::class, 'index'])->name('team.index');
Route::get('team/{team}', [TeamController::class, 'show'])->name('team.show');
Route::get('team/{team}/edit', [TeamController::class, 'edit'])->middleware('can:edit')->name('team.edit');
Route::get('team/create', [TeamController::class, 'create'])->middleware('can:edit')->name('team.create');
Route::post('team/store', [TeamController::class, 'store'])->middleware('can:edit')->name('team.store');
Route::put('team/update', [TeamController::class, 'update'])->middleware('can:edit')->name('team.update');
Route::delete('team/destroy', [TeamController::class, 'destroy'])->middleware('can:edit')->name('team.destroy');

Route::get('team/{team}/players', [PlayerController::class, 'players'])->name('team.players');

Route::get('user', [UserController::class, 'index'])->middleware('can:admin')->name('user.index');
Route::get('user/{user}', [UserController::class, 'show'])->middleware('can:admin')->name('user.show');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->middleware('can:admin')->name('user.edit');
Route::post('user/store', [UserController::class, 'store'])->middleware('can:admin')->name('user.store');
Route::put('user/update', [UserController::class, 'update'])->middleware('can:admin')->name('user.update');
Route::delete('user/destroy', [UserController::class, 'destroy'])->middleware('can:admin')->name('user.destroy');

Route::resource('edition', EditionController::class)->names('edition');

Route::get('/404', function () {
    return abort(404);
})->name('404');