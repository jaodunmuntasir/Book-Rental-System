<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Books::all();
        // $genres = Genre::all();  // Retrieve all genres from the database

        // return view('books.list', [
        //     "books" => $books ,
        // ]);

        // Start with a general query
        $query = Books::query();

        // If there is an 'author' query parameter, adjust the query to filter by author
        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }

        // Execute the query
        $books = $query->get();

        // Retrieve all genres (if you still need this for a sidebar or filter options)
        $genres = Genre::all();

        // Return the view with the books and genres
        return view('books.list', [
            "books" => $books,
            "genres" => $genres
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Books::class);
        $genres = Genre::all();
        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBooksRequest $request)
    {
        $book = Books::create($request->validated());
        $book->genres()->sync($request->genres);  // Attach the genres to the book

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {
        $genres = Genre::all();
        return view('books.show', [
            "book" => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $book)
    {
        $this->authorize('update', $book);
        $book = Books::findOrFail($book->id);
        $genres = Genre::all();
        
        return view('books.edit', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBooksRequest $request, Books $book)
    {
        // $book->update($request->validated());
        $this->authorize('update', $book);

        $validatedData = $request->validated();
    
        // Update the book's basic information.
        $book->update($validatedData);

        // Update the book's genres. The 'genres' field should be an array of genre IDs.
        // This assumes that the name of the input field for genres is 'genres' and it's an array.
        // The `sync` method takes care of attaching, detaching, and updating relationships.
        if (isset($validatedData['genres'])) {
            $book->genres()->sync($validatedData['genres']);
        }

        return redirect()->route('books.show', $book->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        $this->authorize('delete', $book);

        $book = Books::find($book->id);
        $book->delete();

        return redirect()->route('books.index');
    }
}
