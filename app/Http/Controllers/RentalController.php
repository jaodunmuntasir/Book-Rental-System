<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

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
        
        if ($book->in_stock <= 0) {
            return back()->with('error', 'This book is currently not available for rent.');
        }
    
        if ($book->rentals()->where('user_id', Auth::id())->whereNull('returned_at')->exists()) {
            return back()->with('error', 'You have already rented this book.');
        }
        
        Rental::create($request->validated());

        return back()->with('success', 'Rental requested successfully. Waiting for approval.');
        
        // $this->authorize('create', Rental::class);

        // $book = Books::findOrFail($book->id);

        // if ($book->rentals()->where('user_id', Auth::id())->whereNull('returned_at')->exists()) {
        //     return back()->with('error', 'You have already rented this book.');
        // }

        // \Log::info('Request Data:', $request->all());
        // \Log::info('Authenticated User ID:', Auth::id());

        // dd($request->all());

        // $user = Auth::user();
        
        // $rental = new Rental();
        // $rental->user_id = $user->id;
        // $rental->books_id = $book->id;
        // $rental->status = 'Pending Review';
        // $rental->rental_requested_at = now();
        // $rental->save();

        // $user = Auth::user();

        // // Add necessary fields to the request
        // $request->merge([
        //     'user_id' => $user->id,
        //     'books_id' => $book->id,
        //     'status' => 'Pending Review',
        //     'rental_requested_at' => now(),
        // ]);

        // // Now the validation will pass since we have added the required fields
        // $validated = $request->validated();

        // Create the rental record
        // $rental = Rental::create($validated);
        

        // Redirect after successful creation
        

        // $rental = Rental::create([
        //     'user_id' => $user->id,
        //     'books_id' => $book->id,
        //     'status' => 'Pending Review',
        //     'rental_requested_at' => now(),
        // ]);
        
        // if ($rental) {
        //     \Log::info('Rental was created successfully', $rental->toArray());
        // } else {
        //     \Log::error('Rental creation failed.');
        // }

        // \Log::info('Rental Creation Attempt:', $rental->toArray());

        // books()->rentals()->create($request->validated());

        // $book->rentals()->create($request->validated());

        // return redirect()->route('genres.index')->with('success', 'Rental requested successfully. Waiting for approval.');
        // return view('genres.list');

        // return redirect()->route('myrentals');
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
    public function edit(Books $book, Rental $rental)
    {
        $this->authorize('update', $rental);

        $rental = Rental::findOrFail($rental->id);
        $books = Books::all();
        $users = User::all();

        return view('rentals.edit', compact('rental', 'books', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentalRequest $request, Books $book, Rental $rental, User $user)
    {
        $this->authorize('update', $rental);

        $rental->update($request->validated());

        return back()->with('success', 'Rental updated successfully.');
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
        // $this->authorize('manage');
        $rental = Rental::findOrFail($id);
        $rental->update([
            'rental_start_at' => now(),
            'rental_due_at' => now()->addDays(7),
            'status' => 'Approved',
        ]);
        return redirect()->route('rentals.pendinglist')->with('success', 'Rental approved successfully.');
    }

    public function reject($id)
    {
        // $this->authorize('manage');
        $rental = Rental::findOrFail($id);
        $rental->update([
            'status' => 'Cancelled',
        ]);
        return redirect()->route('rentals.pendinglist')->with('success', 'Rental rejected.');
    }

    public function returnBook(Request $request, $id)
    {
        $this->authorize('create', Rental::class);
        
        $rental = Rental::findOrFail($id);
        $rental->update([
            'returned_at' => now(),
            'status' => 'Returned',
        ]);
        return back()->with('success', 'Book returned successfully.');
    }

    public function cancelRentalRequest(Request $request, $id)
    {
        $this->authorize('create', Rental::class);
        
        $rental = Rental::findOrFail($id);
        $rental->update([
            'status' => 'Cancelled',
        ]);
        return back()->with('success', 'Rental request cancelled.');
    }

    public function markOverdue(Request $request)
    {
        // $this->authorize('manage');
        
        $rentals = Rental::where('status', 'Approved')->where('rental_due_at', '<', now())->whereNull('returned_at')->get();

        foreach ($rentals as $rental) {
            $rental->update([
                'status' => 'Overdue'
            ]);
        }

        return back()->with('success', 'Overdue rentals have been updated.');
    }

    public function showRejected ()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Cancelled')->get();
        return view('rentals.rejected', compact('rentals'));
    }

    public function showPending ()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Pending Review')->get();
        return view('rentals.pending', compact('rentals'));
    }

    public function showApproved ()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Approved')->get();
        return view('rentals.approved', compact('rentals'));
    }

    public function showReturned ()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Returned')->get();
        return view('rentals.returned', compact('rentals'));
    }

    public function showOverdue ()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Overdue')->get();
        return view('rentals.overdue', compact('rentals'));
    }

    public function showOngoing ()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')
            ->where('status', 'Approved')
            ->whereNull('returned_at')
            ->where('rental_due_at', '>', now())
            ->get();

        return view('rentals.ongoing', compact('rentals'));
    }

    public function showAll ()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')
            ->whereNotNull('rental_start_at')
            ->get();

        return view('rentals.all', compact('rentals'));
    }

    public function myRentals()
    {
        $user = Auth::user();
        $rentals = $user->rentals()->with('book')->get();

        return view('rentals.myrentals', compact('rentals'));
    }

    public function showReaderRentals(User $user)
    {
        $rentals = $user->rentals()->with('book')->get();

        return view('profile.reader', compact('rentals', 'user'));
    }

}
