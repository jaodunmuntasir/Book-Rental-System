<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Books;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();

        return view('genres.list', [
            "genres" => $genres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        Genre::create($request->validated());

        return redirect()->route('genre.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        $books = $genre->books;

        return view('genres.show', [
            "genre" => $genre,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', [
            "genre" => $genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->update($request->validated());

        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genre.index');
    }

    /**
     * Detach a book to a genre.
     */
    public function detachBook(Genre $genre, Books $book)
    {
        $books = $genre->books;
        $genre->books()->detach($book->id);

        return redirect()->route('genre.show', $genre->id);
    }
}
