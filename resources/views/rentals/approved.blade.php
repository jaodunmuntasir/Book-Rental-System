@extends('layouts.main')

@section('content')

@include('flashmsg')

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="/css/rentals/custom.css">

<div class="container">
    <h2 class="mb-4">Approved Rental Requests</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Rental ID</th>
                <th scope="col">Book Title</th>
                <th scope="col">User</th>
                <th scope="col">Start Date</th>
                <th scope="col">Due Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if ($rentals->isEmpty())
            <tr>
                <td colspan="5">No approved rental requests found.</td>
            </tr>
            @endif

            @foreach ($rentals as $rental)
            <tr>
                <th scope="row">{{ $rental->id }}</th>
                <td>{{ $rental->book->title }}</td>
                <td>{{ $rental->user->name }}</td>
                <td>{{ $rental->rental_start_at }}</td>
                <td>{{ $rental->rental_due_at }}</td>
                <td>
                    <form action="{{ route('books.rentals.edit', ['book' => $rental->book->id, 'rental' => $rental->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn-warning btn-sm">Edit Rental</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
