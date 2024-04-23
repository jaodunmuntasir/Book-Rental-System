@extends('layouts.main')

@section('content')
<div class="container">
    <h2>My Rentals</h2>
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
                <th>Actions</th>
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
                <td>
                    @if ((is_null($rental->returned_at)) && ($rental->status != 'Pending Review') && ($rental->status != 'Cancelled'))
                        <form action="{{ route('rentals.return', $rental->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-warning btn-sm">Return Book</button>
                        </form>
                    @elseif ($rental->status == 'Pending Review')
                        <form action="{{ route('rentals.cancelrequest', $rental->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-danger btn-sm">Cancel Request</button>
                        </form>
                    @elseif ((is_null($rental->returned_at)) && ($rental->status == 'Cancelled'))
                        Request Cancelled/Rejected
                    @else
                        Returned
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
