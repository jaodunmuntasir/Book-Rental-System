<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RentalController;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Controllers\UtilityController;


// Route::get('/', function () {
//     return view('home');
// });
// ->middleware(['auth','verified']);

Route::get('/', [UtilityController::class, 'dashboard'])->name('dashboard');

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
Route::get('/search/suggestions', [UtilityController::class, 'searchSuggetions'])->name('search.suggestions');
Route::get('/search/results', [UtilityController::class, 'searchResults'])->name('search.results');

Route::middleware(['auth','verified'])->group(function () {
    Route::resource("books.rentals", RentalController::class);
});

Route::middleware(['auth','verified', 'role:reader'])->group(function () {
    Route::get('/myrentals', [RentalController::class, 'myRentals'])->name('myrentals');
    Route::patch('/rentals/{rental}/return', [RentalController::class, 'returnBook'])->name('rentals.return');
    Route::patch('/rentals/{rental}/cancel', [RentalController::class, 'cancelRentalRequest'])->name('rentals.cancelrequest');
});

require __DIR__.'/auth.php';


Route::middleware(['auth','verified', 'role:admin,librarian'])->group(function () {
    // The route that handles the deletion of the book_genre connection
    Route::delete('/genres/{genre}/books/{book}', [GenreController::class, 'detachBook'])->name('genres.detachBook');

    // The route that handles rental administration
    Route::get('/rentals/rejectedlist', [RentalController::class, 'showRejected'])->name('rentals.rejectedlist');
    Route::get('/rentals/approvedlist', [RentalController::class, 'showApproved'])->name('rentals.approvedlist');
    Route::get('/rentals/pendinglist', [RentalController::class, 'showPending'])->name('rentals.pendinglist');
    Route::post('/rentals/{rental}/approve', [RentalController::class, 'approve'])->name('rentals.approve');
    Route::post('/rentals/{rental}/reject', [RentalController::class, 'reject'])->name('rentals.reject');
    Route::get('/rentals/returnedlist', [RentalController::class, 'showReturned'])->name('rentals.returnedlist');
    Route::get('/rentals/overduelist', [RentalController::class, 'showOverdue'])->name('rentals.overduelist');
    Route::post('/rentals/markoverdue', [RentalController::class, 'markOverdue'])->name('rentals.markoverdue');
    Route::get('/rentals/ongoinglist', [RentalController::class, 'showOngoing'])->name('rentals.ongoinglist');
    Route::get('/rentals/all', [RentalController::class, 'showAll'])->name('rentals.all');

    Route::get('/readers', [ProfileController::class, 'showReaders'])->name('readers.showreaders');
    Route::get('/readers/{user}/rentals', [RentalController::class, 'showReaderRentals'])->name('readers.rentals');
});

Route::middleware(['auth','verified', 'role:admin'])->group(function () {
    Route::get('/librarians', [ProfileController::class, 'showLibrarians'])->name('librarians.showlibrarians');
    Route::patch('/librarians/{user}/delete', [ProfileController::class, 'changeLibrarianToReader'])->name('librarians.deletelibrarian');
    Route::patch('/readers/{user}/promote', [ProfileController::class, 'changeReaderToLibrarian'])->name('readers.promotelibrarian');
});