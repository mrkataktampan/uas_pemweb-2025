<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HerbalController;
use App\Http\Controllers\Api\PenyakitController;
use App\Http\Middleware\ApiKeyMiddleware;

// Terapkan middleware API key ke semua route API
Route::middleware([ApiKeyMiddleware::class])->group(function () {

    // Herbal routes
    Route::prefix('herbals')->group(function () {
        Route::get('/', [HerbalController::class, 'index']);
        Route::post('/', [HerbalController::class, 'store']);
        Route::get('/{id}', [HerbalController::class, 'show']);
        Route::put('/{id}', [HerbalController::class, 'update']);
        Route::delete('/{id}', [HerbalController::class, 'destroy']);
    });

    // Penyakit routes
    Route::prefix('penyakits')->group(function () {
        Route::get('/', [PenyakitController::class, 'index']);
        Route::post('/', [PenyakitController::class, 'store']);
        Route::get('/{id}', [PenyakitController::class, 'show']);
        Route::put('/{id}', [PenyakitController::class, 'update']);
        Route::delete('/{id}', [PenyakitController::class, 'destroy']);
    });
});