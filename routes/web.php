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
// ->middleware(['auth','verified']);

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

Route::middleware(['auth','verified'])->group(function () {
    Route::resource("books.rentals", RentalController::class);
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
});