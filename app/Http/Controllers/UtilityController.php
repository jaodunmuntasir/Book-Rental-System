<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Genre;
use App\Models\Books;
use App\Models\Rental;

class UtilityController extends Controller
{
    public function dashboard()
    {
        $numberOfReaders = User::where('role', 'reader')->count();
        $numberOfGenres = Genre::count();
        $numberOfBooks = Books::count();
        $numberOfActiveRentals = Rental::where('status', 'Approved')->count();

        // Get the most popular book by rental count
        $popularBook = Rental::select('books_id')
            ->groupBy('books_id')
            ->orderByRaw('COUNT(*) ASC')
            ->first();

        $bookDetails = null;
        if ($popularBook) {
            $bookDetails = Books::find($popularBook->books_id);
        }

        return view('home', [
            'numberOfReaders' => $numberOfReaders,
            'numberOfGenres' => $numberOfGenres,
            'numberOfBooks' => $numberOfBooks,
            'numberOfActiveRentals' => $numberOfActiveRentals,
            'popularBookTitle' => $bookDetails?->title ?? 'N/A',
            'popularBookAuthor' => $bookDetails?->author ?? 'N/A',
            'popularBookCover' => $bookDetails?->cover ?? 'https://easydrawingguides.com/wp-content/uploads/2020/10/how-to-draw-an-open-book-featured-image-1200.png',
        ]);
    }
}
