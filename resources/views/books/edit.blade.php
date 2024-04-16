@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="/css/books/create.css">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit {{ $book -> title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                                    @error('author')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $book->description) }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cover" class="form-label">Cover Image URL</label>
                                    <input type="text" name="cover" id="cover" class="form-control" value="{{ old('cover', $book->cover) }}" required>
                                    @error('cover')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="release_date" class="form-label">Release Date</label>
                                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', $book->release_date) }}" required>
                                    @error('release_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="genre" class="form-label">Genre</label>
                                    <select name="genre" id="genre" class="form-control" required>
                                        <option value="">Select Genre</option>
                                        <option value="Fiction" {{ old('genre', $book->genre) == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                                        <option value="Non-Fiction" {{ old('genre', $book->genre) == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                                        <option value="Science Fiction" {{ old('genre', $book->genre) == 'Science Fiction' ? 'selected' : '' }}>Science Fiction</option>
                                        <option value="Fantasy" {{ old('genre', $book->genre) == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                                        <option value="Mystery" {{ old('genre', $book->genre) == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                                        <option value="Thriller" {{ old('genre', $book->genre) == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                                        <option value="Romance" {{ old('genre', $book->genre) == 'Romance' ? 'selected' : '' }}>Romance</option>
                                        <option value="Horror" {{ old('genre', $book->genre) == 'Horror' ? 'selected' : '' }}>Horror</option>
                                        <option value="Biography" {{ old('genre', $book->genre) == 'Biography' ? 'selected' : '' }}>Biography</option>
                                        <option value="Autobiography" {{ old('genre', $book->genre) == 'Autobiography' ? 'selected' : '' }}>Autobiography</option>
                                    </select>
                                    @error('genre')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="language" class="form-label">Language</label>
                                    <input type="text" name="language" id="language" class="form-control" value="{{ old('language', $book->language) }}" placeholder="Eng" required>
                                    @error('language')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pages" class="form-label">Pages</label>
                                    <input type="number" name="pages" id="pages" class="form-control" value="{{ old('pages', $book->pages) }}" required>
                                    @error('pages')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}" required>
                                    @error('isbn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="in_stock" class="form-label">In Stock</label>
                                    <input type="number" name="in_stock" id="in_stock" class="form-control" value="{{ old('in_stock', $book->in_stock) }}" required>
                                    @error('in_stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

