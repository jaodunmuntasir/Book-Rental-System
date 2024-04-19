<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RentalController;

Route::get('/', function () {
    return view('home');
});

Route::resource("books", BooksController::class);
Route::resource("genres", GenreController::class);

// The route that handles the deletion of the book_genre connection
Route::delete('/genres/{genre}/books/{book}', [GenreController::class, 'detachBook'])->name('genres.detachBook');

Route::resource("books.rentals", RentalController::class);
