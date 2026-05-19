<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- Aquí agregamos la importación de Gate

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
    public function boot(): void
    {
        // Reglas de autorización (Gates)
        
        Gate::define('view-dashboard', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor');
        });

        Gate::define('edit-post', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor');
        });

        Gate::define('delete-post', function ($user) {
            return $user->hasRole('admin'); // Solo los administradores pueden borrar
        });
    }
}