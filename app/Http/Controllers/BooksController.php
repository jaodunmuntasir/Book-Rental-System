<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();

        return view('books.list', [
            "books" => $books ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBooksRequest $request)
    {
        Books::create($request->validated());

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {
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
        
        return view('books.edit', [
            "book" => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBooksRequest $request, Books $book)
    {
        $book->update($request->validated());

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
