<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;

Route::get('/', function () {
    return view('home');
});

Route::resource("books", BooksController::class);
Route::resource("genre", GenreController::class);

// The route that handles the deletion of the book_genre connection
Route::delete('/genre/{genre}/books/{book}', [GenreController::class, 'detachBook'])->name('genre.detachBook');
