<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\LanguageController;

Route::get("language/{locale}", LanguageController::class)->name('language');

Route::get('/', function () {
    return view('index');
});

Route::resource('peliculas', PeliculaController::class);

Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas.index');
Route::post('/peliculas', [PeliculaController::class, 'store'])->name('peliculas.store');
Route::get('/peliculas/create', [PeliculaController::class, 'create'])->name('peliculas.create');
Route::get('/peliculas/{peliculas}', [PeliculaController::class, 'show'])->name('peliculas.show');
Route::get('/peliculas/{peliculas}/edit', [PeliculaController::class, 'edit'])->name('peliculas.edit');
Route::put('/peliculas/{peliculas}', [PeliculaController::class, 'update'])->name('peliculas.update');
Route::delete('/peliculas/{peliculas}', [PeliculaController::class, 'destroy'])->name('peliculas.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
