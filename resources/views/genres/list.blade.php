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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>Genres List</h5>
                </div>
                <div class="card-body">
                    <table id="table1" class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Style</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($genres as $genre)
                                <tr>
                                    <th scope="row">{{ $genre->id }}</th>
                                    <td>{{ $genre->name }}</td>
                                    <td>{{ $genre->style }}</td>
                                    <td>
                                        <a href="{{ route('genres.show', $genre->id) }}" class="btn btn-sm btn-primary">View Books</a>
                                        @auth
                                        @if($isAdmin || $isLibrarian)
                                        <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        
                                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                                            <!-- onclick="return confirm('Are you sure?')" -->
                                        </form>
                                        @endif
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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