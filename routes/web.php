<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Grupo de rutas que requieren autenticación y verificación de email
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Ruta del dashboard protegida adicionalmente para admin y editor mediante tu middleware
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('role:admin,editor')->name('dashboard');

    // Rutas de posts (Comentadas por ahora hasta crear el PostController en la Práctica 2)
    // Route::post('/posts', [PostController::class, 'store'])->middleware('role:editor');
    // Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('role:admin');
});

// Grupo de rutas del perfil de usuario (requieren autenticación básica)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';