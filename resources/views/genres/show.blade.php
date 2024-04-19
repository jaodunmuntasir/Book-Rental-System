@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="/css/genres/show.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5>Books in Genre: {{ $genre->name }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($genre->books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View Book</a>
                                    
                                    <form action="{{ route('genre.detachBook', ['genre' => $genre->id, 'book' => $book->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger btn-sm">Delete Connection</button>
                                    </form>
                                    
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

<script>
    function deleteConnection(genreId, bookId) {
        if(confirm('Are you sure you want to remove this book from the genre?')) {
            fetch(`/genre/${genreId}/book/${bookId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => res.json())
            .then(response => {
                if(response.success) {
                    window.location.reload();
                } else {
                    alert('There was an error removing the book from the genre.');
                }
            });
        }
    }
</script>

@endsection
