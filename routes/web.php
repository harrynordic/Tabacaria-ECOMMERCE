<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; // Controller do front-end
use App\Http\Controllers\Admin\ProductController as AdminProductController; // Controller do painel administrativo
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController; // Controller do painel administrativo de categorias
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str; // Opcional aqui, mas não faz mal

// Rota raiz: Redireciona para a home do seu e-commerce
Route::get('/', function () {
    return redirect()->route('home'); // Redireciona para a rota nomeada 'home'
});

// Rotas do Dashboard e Perfil do Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Suas ROTAS DO FRONT-END (públicas) para o e-commerce ---

// Rota para a página inicial da tabacaria
Route::get('/home', function () {
    return view('home'); // Carrega a view home.blade.php
})->name('home'); // Dá um nome para a rota

// Rotas para produtos (listar e ver detalhes)
Route::get('/produtos', [ProductController::class, 'index'])->name('products.index'); // Chama o ProductController (do front-end) para listar
Route::get('/produtos/{id}', [ProductController::class, 'show'])->name('products.show'); // Chama o ProductController para detalhes (passando um ID)

// Rota para listar produtos por categoria (NOVA ROTA AQUI!)
// Esta rota vai chamar um novo método 'indexByCategory' no seu ProductController (do front-end)
Route::get('/categorias/{slug}', [ProductController::class, 'indexByCategory'])->name('categories.show');

// --- Rotas do Painel Administrativo (Protegidas) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Rota para o dashboard principal do admin
    Route::get('/', function () {
        return view('admin.dashboard'); // View do dashboard admin
    })->name('admin.dashboard');

    // Rotas de recursos para produtos (CRUD completo)
    Route::resource('products', AdminProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    // Rotas de recursos para categorias (CRUD completo)
    Route::resource('categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
});

require __DIR__.'/auth.php'; // Rotas de autenticação do Breeze (Mantenha esta linha por último)