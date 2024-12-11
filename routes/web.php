<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authorized;
use App\Http\Middleware\Guest;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::middleware(Authorized::class)->group(function() {
    Route::get('/terminate', [LoginController::class, 'logout'])->name('signout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(Guest::class)->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('signin');
    Route::get('/register', [LoginController::class, 'add'])->name('signup');
    Route::get('/forgot', [LoginController::class, 'forgot'])->name('forgot');

    Route::post('/validate', [LoginController::class, 'validate'])->name('validate');
});
