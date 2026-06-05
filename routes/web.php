<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
 
// Redirección de la raíz al catálogo de libros
Route::redirect('/', '/books');
 
// Rutas RESTful para libros y autores
Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);

