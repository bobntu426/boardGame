<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PlayerController;



Route::put('/joinTable/{table}', [PlayerController::class, 'joinTable'])->name('joinTable');
Route::put('/leaveTable/{table}', [PlayerController::class, 'leaveTable'])->name('leaveTable');
Route::post('/initGameCard/{table}', [TableController::class, 'initGameCard'])->name('initGameCard');
Route::get('/players/{player}/cards', [PlayerController::class, 'getPlayerCards'])->name('getPlayerCards');
Route::get('/tables/{table}/cards', [TableController::class, 'getTableCards'])->name('getTableCards');
Route::put('/players/buy-card', [PlayerController::class, 'buyCard'])->name('buyCard');
Route::put('/players/use-card', [PlayerController::class, 'useCard'])->name('useCard');

Route::get('/user', [UserController::class, 'getMe']);
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/players/{table}', [PlayerController::class, 'getPlayerInTable']);

Route::resource('users', UserController::class);
Route::resource('card-tables', CardController::class);
Route::resource('tables', TableController::class);
Route::resource('players', PlayerController::class);

Route::get('/{any}', function () {
    return view('index'); // 返回 Vue 应用的主视图
})->where('any', '.*');

