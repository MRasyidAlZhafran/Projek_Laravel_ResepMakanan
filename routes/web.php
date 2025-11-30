<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/resep', [RecipeController::class, 'index'])->name('recipes.index');
Route::post('/resep', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');
Route::delete('/resep/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

Route::post('/recipes/{id}/favorite/add', [RecipeController::class, 'addFavorite'])->name('recipes.addFavorite');
Route::post('/recipes/{id}/favorite/remove', [RecipeController::class, 'removeFavorite'])->name('recipes.removeFavorite');
Route::get('/favorit', [RecipeController::class, 'favorites'])->name('recipes.favorites');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::post('/recipes/{id}/rate', [RatingController::class, 'store'])->name('recipes.rate');

Route::get('/recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{id}', [RecipeController::class, 'update'])->name('recipes.update');
