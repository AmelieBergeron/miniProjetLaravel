<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommentaireController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function ()
{
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::controller(CommentaireController::class)->group(function () {
            Route::get('/commentaires', 'create')->name('commentaires');
            Route::post('/commentaires/sent', 'store')->name('insertionCommentaire');
        });
    });

    Route::controller(ProduitController::class)->group(function () {
        Route::get('/produits', 'index')->name('produits');
        Route::get('/produits/{id}', 'show')->name('produit');
        Route::get('/produits/categorie/{id}', 'show')->name('produitsCategorie');
        Route::get('/modification/produit', 'edit')->name('modificationProduit')->middleware(EnsureUserIsAdmin::class);
        Route::post('/suppression/produit', 'destroy')->name('suppressionProduit')->middleware(EnsureUserIsAdmin::class);
        Route::post('/enregistrement/produit/{id}', 'update')->name('enregistrementProduit')->middleware(EnsureUserIsAdmin::class);
    });

    Route::controller(CategorieController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories');
        Route::get('/categorie/{id}', 'index')->name('categorie');
    });

    /*Route::controller(CommentaireController::class)->group(function () {
        Route::get('/commentaires', 'create')->name('commentaires');
        Route::post('/commentaires/sent', 'store')->name('insertionCommentaire');
        //Route::get('/commentaires/confirmation', 'show')->name('confirmationCommentaire');
    });*/
});

require __DIR__ . '/auth.php';
