<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ProduitController::class)->group(function() {
    //Route::get('/produit/{id}', 'show')->name('produitApi');
    Route::get('/produit/{id}', 'show')->name('produitApi')->middleware('auth:sanctum');
    Route::post('/insertion/produit', 'store')->name('insertionProduitApi')->middleware(['auth:sanctum', EnsureUserIsAdmin::class]);
});

Route::controller(CategorieController::class)->group(function() {
    Route::get('/categories', 'index')->name('categoriesApi');
    Route::post('/insertion/categorie', 'store')->name('insertionCategorieApi')->middleware(['auth:sanctum', EnsureUserIsAdmin::class]);
});

Route::post('/token', [RegisteredUserController::class, 'show'])->name('token');
