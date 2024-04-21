@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="/css/genres/create.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Edit Genre - {{ $genre->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Genre Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $genre->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="style" class="form-label">Style</label>
                            <select class="form-select" id="style" name="style">
                                <option value="primary" {{ $genre->style == 'primary' ? 'selected' : '' }}>Primary</option>
                                <option value="secondary" {{ $genre->style == 'secondary' ? 'selected' : '' }}>Secondary</option>
                                <option value="success" {{ $genre->style == 'success' ? 'selected' : '' }}>Success</option>
                                <option value="danger" {{ $genre->style == 'danger' ? 'selected' : '' }}>Danger</option>
                                <option value="warning" {{ $genre->style == 'warning' ? 'selected' : '' }}>Warning</option>
                                <option value="info" {{ $genre->style == 'info' ? 'selected' : '' }}>Info</option>
                                <option value="light" {{ $genre->style == 'light' ? 'selected' : '' }}>Light</option>
                                <option value="dark" {{ $genre->style == 'dark' ? 'selected' : '' }}>Dark</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update Genre</button>
                        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
