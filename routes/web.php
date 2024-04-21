<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RentalController;
use App\Http\Middleware\EnsureUserHasRole;


Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    return view('test');
})->middleware(['auth','verified', 'role:admin,librarian']);

Route::get('/forbidden', function () {
    return view('forbidden');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource("books", BooksController::class);
Route::resource("genres", GenreController::class);

// The route that handles the deletion of the book_genre connection
Route::delete('/genres/{genre}/books/{book}', [GenreController::class, 'detachBook'])->name('genres.detachBook');

Route::resource("books.rentals", RentalController::class);

require __DIR__.'/auth.php';