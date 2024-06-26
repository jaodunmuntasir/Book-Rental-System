@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/tables.css">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@php
    $user = auth()->user();
    $isAdmin = $user && ($user->role === 'admin');
    $isLibrarian = $user && ($user->role === 'librarian');
    $isReader = $user && ($user->role === 'reader');
@endphp

<div class="container">
    <h2>Readers List</h2>
    <table id="table1" class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Profile Creation Date</th>
                <th>Actions</th>
                @auth
                @if ($isAdmin)
                <th>Admin Actions</th>
                @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            @if ($users->isEmpty())
            <tr>
                <td colspan="8">No Reader found.</td>
            </tr>
            @endif

            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td><a href="{{ route('readers.rentals', $user->id) }}" class="btn btn-sm btn-primary">View Rentals</a></td>
                <td>
                    @auth
                    @if ($isAdmin)
                    <form action="{{ route('readers.promotelibrarian', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-danger btn-sm">Make Librarian</button>
                    </form>
                    @endif
                    @endauth
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
