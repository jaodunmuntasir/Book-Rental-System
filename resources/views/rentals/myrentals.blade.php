@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/tables.css">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<div class="container">
    <h2>My Rentals</h2>
    <table id="table1" class="table">
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

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#table1').DataTable({
            "paging": false,   // Disables pagination
            "searching": true, // Disables the search bar
            "info": false     // Disables the information text
        });

        // Event listener to the search box to perform search
        $('#table_search').keyup(function(){
            table.search($(this).val()).draw(); // Search and redraw the table
        });
    });
</script>

@endsection
