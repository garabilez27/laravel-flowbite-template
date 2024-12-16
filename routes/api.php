<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authorized;

use App\Http\Resources\MenuResource;
use App\Http\Resources\SubMenuResource;
use App\Models\Menus;
use App\Models\SubMenus;

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

            // Sub Menu API
            Route::prefix('subs')->group(function() {
                Route::get('/', function() {
                    return SubMenuResource::collection(SubMenus::paginate());
                });
                Route::get('/{id}', function(string $id) {
                    return new SubMenuResource(SubMenus::whereRaw('md5(sbmn_id) = ?', $id)->first());
                });
            });
        });
    });
});
