@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                Add New Book
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" id="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select name="genre" id="genre" class="form-control" required>
                            <option value="">Select Genre</option>
                            <option value="Fiction">Fiction</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                            <option value="Science Fiction">Science Fiction</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Romance">Romance</option>
                            <option value="Horror">Horror</option>
                            <option value="Biography">Biography</option>
                            <option value="Autobiography">Autobiography</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="date" name="release_date" id="release_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pages">Pages</label>
                        <input type="number" name="pages" id="pages" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="in_stock">In Stock</label>
                        <input type="number" name="in_stock" id="in_stock" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection