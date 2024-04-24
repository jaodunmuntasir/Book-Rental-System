@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Rentals of {{ $user->name }} </h2>
    <table class="table">
        <thead>
            <tr>
                <th>Rental ID</th>
                <th>Book Title</th>
                <th>Book Author</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Returned Date</th>
            </tr>
        </thead>
        <tbody>
            @if ($rentals->isEmpty())
            <tr>
                <td colspan="8">No rental found.</td>
            </tr>
            @endif

            @foreach ($rentals as $rental)
            <tr>
                <td>{{ $rental->id }}</td>
                <td>{{ $rental->book->title }}</td>
                <td>{{ $rental->book->author }}</td>
                <td>{{ $rental->status }}</td>
                <td>{{ $rental->rental_requested_at }}</td>
                <td>{{ $rental->rental_start_at }}</td>
                <td>{{ $rental->rental_due_at }}</td>
                <td>{{ $rental->returned_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
