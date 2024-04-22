<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Models\Books;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentalRequest $request, Books $book)
    {
        $book = Books::findOrFail($book->id);
        if ($book->rentals()->where('user_id', Auth::id())->whereNull('returned_at')->exists()) {
            return back()->with('error', 'You have already rented this book.');
        }

        Rental::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rental_requested_at' => now(),
        ]);

        return redirect()->route('books.index')->with('success', 'Rental requested successfully. Waiting for approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentalRequest $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }
}
