<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ActorController;


Route::get("language/{locale}", LanguageController::class)->name('language');

Route::get('/', function () {
    return view('index');
})->name('index');


Route::resource('peliculas', PeliculaController::class);

Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas.index');
Route::post('/peliculas', [PeliculaController::class, 'store'])->name('peliculas.store');
Route::get('/peliculas/create', [PeliculaController::class, 'create'])->name('peliculas.create');
Route::get('/peliculas/{peliculas}', [PeliculaController::class, 'show'])->name('peliculas.show');
Route::get('/peliculas/{peliculas}/edit', [PeliculaController::class, 'edit'])->name('peliculas.edit');
Route::put('/peliculas/{peliculas}', [PeliculaController::class, 'update'])->name('peliculas.update');
Route::delete('/peliculas/{peliculas}', [PeliculaController::class, 'destroy'])->name('peliculas.destroy');

Route::resource('actores', ActorController::class);

Route::get('/actores', [ActorController::class, 'index'])->name('actores.index');
Route::post('/actores', [ActorController::class, 'store'])->name('actores.store');
Route::get('/actores/create', [ActorController::class, 'create'])->name('actores.create');
Route::get('/actores/{actores}', [ActorController::class, 'show'])->name('actores.show');
Route::get('/actores/{actores}/edit', [ActorController::class, 'edit'])->name('actores.edit');
Route::put('/actores/{actores}', [ActorController::class, 'update'])->name('actores.update');
Route::delete('/actores/{actores}', [ActorController::class, 'destroy'])->name('actores.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
