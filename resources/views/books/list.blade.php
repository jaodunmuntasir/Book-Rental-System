@extends('layouts.main')

@section('content')

@include('flashmsg')

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<link rel="stylesheet" href="/css/books/list.css">
<link rel="stylesheet" href="/css/tables.css">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


@php
    $user = auth()->user();
    $isAdmin = $user && ($user->role === 'admin');
    $isLibrarian = $user && ($user->role === 'librarian');
    $isReader = $user && ($user->role === 'reader');
@endphp

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header ">
                    <h4 class="mb-0">List of Books</h4>
                </div>
                <div class="card-body p-0">
                <!-- <input type="text" id="table_search" class="form-control mb-3" placeholder="Search table..."> -->
                    <table id="table1" class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr style=text-align:center>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Language</th>
                                <th>Genre</th>
                                <th>Pages</th>
                                <th>Release Date</th>
                                <!-- <th>Description</th> -->
                                <!-- <th>ISBN</th> -->
                                <th>In Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr style=text-align:center>
                                <td><img src="{{ $book->cover }}" alt="Cover" class="book-cover"></td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->language }}</td>
                                <td>
                                    @foreach($book->genres as $genre)
                                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $book->pages }}</td>
                                <td>{{ $book->release_date }}</td>
                                <!-- <td>{{ $book->description }}</td> -->
                                <!-- <td>{{ $book->isbn }}</td> -->
                                <td>{{ $book->in_stock }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-custom-size btn-primary">View</a>
                                    @auth
                                    @if($isReader)
                                        <form action="{{ route('books.rentals.store', ['book' => $book->id]) }}" method="POST">
                                            @csrf
                                            <!-- <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                            <input type="hidden" name="books_id" value="{{ $book->id }}">
                                            <input type="hidden" name="status" value="Pending Review">
                                            <input type="hidden" name="rental_requested_at" value="{{ now() }}"> -->
                                            <button type="submit" class="btn btn-custom-size btn-primary">Rent Book</button>
                                        </form>
                                    @endif

                                    @if($isAdmin || $isLibrarian)
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-custom-size btn-primary">Edit</a>
                                        <!-- <a href="{{ route("books.destroy", ["book" => $book -> id]) }}" class="btn btn-sm btn-danger delete-btn"></a> -->
                                        <!-- <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $book->id }}">Delete</button> -->
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-custom-size btn-danger delete-btn">Delete</button>
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