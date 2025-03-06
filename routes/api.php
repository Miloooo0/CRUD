<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActorController;
use App\Http\Controllers\Api\PeliculaController;

Route::middleware('api')->group(function () {
    Route::apiResource('actores', ActorController::class);
    Route::apiResource('peliculas', PeliculaController::class);
});
