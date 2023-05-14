<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categorias/crear', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categorias/{id}/editar', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categorias/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categorias/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::patch('/categorias/{id}/restaurar', [CategoryController::class, 'restore'])->name('categories.restore');

    Route::get('/productos', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/productos/crear', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/productos/crear', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/productos/{id}/editar', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/productos/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/productos/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
    Route::patch('/productos/{id}/restaurar', [ProductsController::class, 'restore'])->name('products.restore');

    Route::get('/motos', [MotosController::class, 'index'])->name('motos.index');
    Route::get('/motos/crear', [MotosController::class, 'create'])->name('motos.create');
    Route::post('/motos/crear', [MotosController::class, 'store'])->name('motos.store');
    Route::get('/motos/{id}', [MotosController::class, 'show'])->name('motos.show');
    Route::get('/motos/{id}/editar', [MotosController::class, 'edit'])->name('motos.edit');
    Route::put('/motos/{id}', [MotosController::class, 'update'])->name('motos.update');
    Route::delete('/motos/{id}', [MotosController::class, 'destroy'])->name('motos.destroy');
    Route::patch('/motos/{id}/restaurar', [MotosController::class, 'restore'])->name('motos.restore');
    Route::delete('/motos/{id}/force', [MotosController::class, 'forceDelete'])->name('motos.forceDelete');
});

require __DIR__ . '/auth.php';
