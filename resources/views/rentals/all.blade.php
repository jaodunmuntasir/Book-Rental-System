@extends('layouts.main')

@section('content')

@include('flashmsg')

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="/css/rentals/custom.css">

<div class="container">
    <h2 class="mb-4">All Rentals</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Rental ID</th>
                <th scope="col">Book Title</th>
                <th scope="col">User</th>
                <th scope="col">Status</th>
                <th scope="col">Start Date</th>
                <th scope="col">Due Date</th>
                <th scope="col">Return Date</th>
            </tr>
        </thead>
        <tbody>
            @if ($rentals->isEmpty())
                <tr>
                    <td colspan="5">No rental found.</td>
                </tr>
            @endif

            @foreach ($rentals as $rental)
                <tr>
                    <th scope="row">{{ $rental->id }}</th>
                    <td>{{ optional($rental->book)->title ?? 'Book not available' }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->status }}</td>
                    <td>{{ $rental->rental_start_at}}</td>
                    <td>{{ $rental->rental_due_at}}</td>
                    <td>{{ $rental->returned_at}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection