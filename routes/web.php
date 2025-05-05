<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Middleware\Admin;
 
use App\Http\Middleware\AuthMiddleware;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/dashboard', [MyAccountController::class, 'index'])
        ->name('dashboard');

});


Route::resource('/admin', AdminController::class)
    ->names('admin')
    ->parameters(['admin' => 'product'])  
    ->middleware(Admin::class);
