<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/do-login', [AuthController::class, 'login'])->name('doLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class);
Route::post('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');

