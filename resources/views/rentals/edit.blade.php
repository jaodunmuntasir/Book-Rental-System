@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="container mt-4">
    <h2>Edit Rental</h2>
    <form action="{{ route('books.rentals.update', ['book' => $rental->book->id, 'rental' => $rental->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="user" class="form-label">User</label>
            <input type="text" class="form-control" id="user" name="user" value="{{ $rental->user->name }}" disabled>
        </div>

        <div class="mb-3">
            <label for="book_title" class="form-label">Book Title</label>
            <input type="text" class="form-control" id="book_title" name="book_title" value="{{ $rental->book->title }}" disabled>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option {{ $rental->status == 'Pending Review' ? 'selected' : '' }}>Pending Review</option>
                <option {{ $rental->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option {{ $rental->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                <option {{ $rental->status == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                <option {{ $rental->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="rental_requested_at" class="form-label">Rental Request Date</label>
            <input type="text" class="form-control" id="rental_requested_at" name="rental_requested_at" value="{{ $rental->rental_requested_at }}" readonly>
        </div>

        <div class="mb-3">
            <label for="rental_start_at" class="form-label">Rental Start Date and Time</label>
            <input type="datetime-local" class="form-control" id="rental_start_at" name="rental_start_at" value="{{ $rental->rental_start_at ? $rental->rental_start_at->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="mb-3">
            <label for="rental_due_at" class="form-label">Due Date and Time</label>
            <input type="datetime-local" class="form-control" id="rental_due_at" name="rental_due_at" value="{{ $rental->rental_due_at ? $rental->rental_due_at->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="mb-3">
            <label for="rental_returned_at" class="form-label">Returned Date and Time</label>
            <input type="datetime-local" class="form-control" id="rental_returned_at" name="rental_returned_at" value="{{ $rental->returned_at ? $rental->returned_at->format('Y-m-d\TH:i') : '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Rental</button>
    </form>
</div>
@endsection
