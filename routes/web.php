<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\MyAccountController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [MyAccountController::class, 'index'])->name('dashboard');