<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authorized;
use App\Http\Middleware\Guest;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubMenuController;

Route::middleware(Authorized::class)->group(function() {
    Route::get('/terminate', [LoginController::class, 'logout'])->name('signout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('settings')->group(function() {
        Route::get('settings', [SettingController::class, 'index'])->name('settings');

        // Menus
        Route::prefix('menus')->group(function() {
            Route::get('/', [MenuController::class, 'index'])->name('mn.index');
        });

        // Sub Menus
        Route::prefix('subs')->group(function() {
            Route::get('/', [SubMenuController::class, 'index'])->name('sbmn.index');
        });

        // Roles
        Route::prefix('roles')->group(function() {
            Route::get('/', [RoleController::class, 'index'])->name('rl.index');
        });
    });
});

Route::middleware(Guest::class)->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('signin');
    Route::get('/register', [LoginController::class, 'add'])->name('signup');
    Route::get('/forgot', [LoginController::class, 'forgot'])->name('forgot');

    Route::post('/validate', [LoginController::class, 'validate'])->name('validate');
});
