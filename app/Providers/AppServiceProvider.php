<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        // Verifica si hay un idioma en la sesión y lo establece
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        //USO DE LAS APIS
        Route::middleware('api')
        ->prefix('api')
        ->group(base_path('routes/api.php'));

    }
}