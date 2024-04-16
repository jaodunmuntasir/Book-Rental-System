@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="/css/books/show.css">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ $book->cover }}" class="card-img-top book-cover" alt="Book Cover">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><span class="detail-label">Author:</span> {{ $book->author }} </p>
                    <p class="card-text"><span class="detail-label">Genre:</span> 
                        @foreach($book->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->name }}</span>
                        @endforeach
                    </p>
                    <p class="card-text"><span class="detail-label">Publish Date:</span> {{ $book->release_date }} </p>
                    <p class="card-text"><span class="detail-label">Number of Pages:</span>  {{ $book->pages }}</p>
                    <p class="card-text"><span class="detail-label">Language:</span> {{ $book->language }} </p>
                    <p class="card-text"><span class="detail-label">ISBN:</span> {{ $book->isbn }}</p>
                    <p class="card-text"><span class="detail-label">Total Copies:</span> {{$book->in_stock }}</p>
                    <p class="card-text"><span class="detail-label">Available Copies:</span> 0 </p>
                    <p class="card-text"><span class="detail-label">Description:</span> {{ $book->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection