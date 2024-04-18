<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Models\Genre;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();
        $genres = Genre::all();  // Retrieve all genres from the database

        return view('books.list', [
            "books" => $books ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $book = Books::find($book->id);
        $book->delete();

        return redirect()->route('books.index');
    }
}
