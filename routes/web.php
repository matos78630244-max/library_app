<?php
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','/books');
Route::resource('books',BookController::class);
Route::resource('authors',AuthorController::class);
Route::resource('categories', CategoriesController::class);
