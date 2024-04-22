<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'books_id' => $book->id,
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

    public function approve($id)
    {
        // $this->authorize('manage-rentals');
        $rental = Rental::findOrFail($id);
        $rental->update([
            'rental_start_at' => now(),
            'rental_due_at' => now()->addDays(7),
            'status' => 'Approved',
        ]);
        return redirect()->route('rentals.pending')->with('success', 'Rental approved successfully.');
    }

    public function reject($id)
    {
        // $this->authorize('manage-rentals');
        $rental = Rental::findOrFail($id);
        $rental->update([
            'status' => 'Cancelled',
        ]);
        return redirect()->route('rentals.pendinglist')->with('success', 'Rental rejected.');
    }

    public function returnBook(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        $rental->update([
            'returned_at' => now(),
            'status' => 'Completed',
        ]);
        return back()->with('success', 'Book returned successfully.');
    }

    public function showRejected ()
    {
        // $this->authorize('manage-rentals');
        $rentals = Rental::with('book', 'user')->where('status', 'Cancelled')->get();
        return view('rentals.rejected', compact('rentals'));
    }

    public function showPending ()
    {
        // $this->authorize('manage-rentals');
        $rentals = Rental::with('book', 'user')->where('status', 'Pending Review')->get();
        return view('rentals.pending', compact('rentals'));
    }

    public function showApproved ()
    {
        // $this->authorize('manage-rentals');
        $rentals = Rental::with('book', 'user')->where('status', 'Approved')->get();
        return view('rentals.approved', compact('rentals'));
    }
}
