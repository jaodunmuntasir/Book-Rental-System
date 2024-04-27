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

    public function searchSuggestions(Request $request)
    {
        $term = $request->get('term');
        $suggestions = [];

        // Query Books by title
        $books = Books::where('title', 'like', "%{$term}%")
                    ->take(5)
                    ->get(['id', 'title']);

        // Add book suggestions
        foreach ($books as $book) {
            $suggestions[] = [
                'label' => 'Book: ' . $book->title,
                'value' => $book->title,
                'url' => route('books.show', $book->id)
            ];
        }

        // Query Genres
        $genres = Genre::where('name', 'like', "%{$term}%")
                    ->take(5)
                    ->get(['id', 'name']);

        // Add genre suggestions
        foreach ($genres as $genre) {
            $suggestions[] = [
                'label' => 'Genre: ' . $genre->name,
                'value' => $genre->name,
                'url' => route('genres.show', $genre->id)
            ];
        }

        // Query for Authors and include the books associated with them
        $authorSuggestions = Books::select('author')
                              ->distinct()
                              ->where('author', 'like', "%{$term}%")
                              ->take(5)
                              ->with('genres')
                              ->get();

        foreach ($authorSuggestions as $author) {
            $suggestions[] = [
                'label' => 'Author: ' . $author->author,
                'value' => $author->author,
                'url'   => route('books.index', ['author' => $author->author]) // You can create a route to filter books by author
            ];
        }

        return response()->json($suggestions);
    }

    public function searchResults(Request $request)
    {
        $query = $request->get('query');

        // Start with a query that will search for the title in the books table
        $bookQuery = Books::query();

        // If the search query is not empty
        if (!empty($query)) {
            // Search for matching book title or author
            $bookQuery->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                ->orWhere('author', 'LIKE', "%{$query}%");
            });

            // Extend the query to include genres if there's a relationship
            $bookQuery->orWhereHas('genres', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            });
        }

        // Execute the query and get the results
        $books = $bookQuery->get();

        // Return the view with the books collection
        return view('search.results', compact('books'));
    }


}
