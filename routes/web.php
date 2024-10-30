<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TableController;


Route::get('/users/getCard', [UserController::class, 'getMyCard'])->name('getMyCard');
Route::get('/user', [UserController::class, 'getMe']);



Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::put('/buyCard/{card}', [UserController::class, 'buyCard'])->name('buyCard');
Route::put('/useCard/{card}', [UserController::class, 'useCard'])->name('useCard');
Route::put('/joinTable/{table}', [UserController::class, 'joinTable'])->name('joinTable');


Route::resource('users', UserController::class);
Route::resource('cards', CardController::class);
Route::resource('tables', TableController::class);

Route::get('/{any}', function () {
    return view('index'); // 返回 Vue 应用的主视图
})->where('any', '.*');

