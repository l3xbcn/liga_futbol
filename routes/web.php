<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Models\Player;
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
    return redirect(request()->getSchemeAndHttpHost().'/player' );
});

Route::post('player/store', [PlayerController::class, 'store']);
Route::put('player/update', [PlayerController::class, 'update']);
Route::delete('player/destroy', [PlayerController::class, 'destroy']);
Route::resource('player', PlayerController::class)->names('player');


Route::get('teams/{team}/players', [PlayerController::class, 'players']);
Route::post('team/store', [TeamController::class, 'store']);
Route::put('team/update', [TeamController::class, 'update']);
Route::delete('team/destroy', [TeamController::class, 'destroy']);
Route::resource('team', TeamController::class)->names('team');


Route::get('user', [UserController::class, 'index'])->middleware('can:edit');
Route::get('user/{user}', [UserController::class, 'show'])->middleware('can:admin');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->middleware('can:admin');
Route::post('user/store', [UserController::class, 'store'])->middleware('can:admin');
Route::put('user/update', [UserController::class, 'update'])->middleware('can:admin');
Route::delete('user/destroy', [UserController::class, 'destroy'])->middleware('can:admin');
