@extends('layouts.main')

@section('content')

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="/css/rentals/custom.css">

<div class="container">
    <h2>Overdue Rentals</h2>
    <form action="{{ route('rentals.markoverdue') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning">Mark Overdue Rentals</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Rental ID</th>
                <th>Book Title</th>
                <th>User</th>
                <th>Start Date</th>
                <th>Due Date</th>
                
            </tr>
        </thead>
        <tbody>
            @if($rentals->isEmpty())
            <tr>
                <td colspan="5">No overdue rentals found.</td>
            </tr>
            @endif

            @foreach($rentals as $rental)
            <tr>
                <td>{{ $rental->id }}</td>
                <td>{{ $rental->book->title }}</td>
                <td>{{ $rental->user->name }}</td>
                <td>{{ $rental->rental_start_at }}</td>
                <td>{{ $rental->rental_due_at }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
