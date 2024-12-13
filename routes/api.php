<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authorized;

use App\Http\Resources\MenuResource;
use App\Models\Menus;

Route::middleware(Authorized::class)->group(function() {
    Route::prefix('api')->group(function() {
        Route::prefix('v1')->group(function() {
            // Menu API
            Route::prefix('menus')->group(function() {
                Route::get('/', function() {
                    return MenuResource::collection(Menus::paginate());
                });
                Route::get('/{id}', function(string $id) {
                    return new MenuResource(Menus::whereRaw('md5(mn_id) = ?', $id)->first());
                });
            });
        });
    });
});
