<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PlayerController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckPlayerTurnAndPillar;


Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/check-login', [LoginController::class, 'checkLogin'])->name('checkLogin');
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::put('/join-table/{table}', [PlayerController::class, 'joinTable'])->name('joinTable');
    Route::put('/leave-table/{table}', [PlayerController::class, 'leaveTable'])->name('leaveTable');
    // Route::put('/players/use-card', [PlayerController::class, 'useCard'])->name('useCard');
    Route::post('/tables', [TableController::class, 'createTable'])->name('createTable');
    Route::middleware([CheckPlayerTurnAndPillar::class])->group(function () {
        Route::put('/games/decide-order', [PlayerController::class, 'decideOrder']);
        Route::put('/games/reset', [PlayerController::class, 'reset']);
        Route::put('/games/end-turn', [PlayerController::class, 'endTurn']);
        Route::put('/players/buy-card', [PlayerController::class, 'buyCard'])->name('buyCard');
    });
});

Route::get('/players/{player}/cards', [PlayerController::class, 'getPlayerCards'])->name('getPlayerCards');
Route::get('/tables/{table}/cards', [TableController::class, 'getTableCards'])->name('getTableCards');
Route::get('/players/{table}', [PlayerController::class, 'getPlayerInTable'])->name('getPlayerInTable');
Route::get('/games/{table}', [TableController::class, 'getGameInfo'])->name('getGameInfo');
Route::get('/tables', [TableController::class, 'getTable'])->name('getTable');
Route::get('/user', [UserController::class, 'getMe']);
Route::resource('users', UserController::class);
Route::resource('card-tables', CardController::class);
Route::resource('players', PlayerController::class);
Route::get('/{any}', function () {
    return view('index'); // 返回 Vue 应用的主视图
})->where('any', '.*');

