@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="/css/genres/create.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Create New Genre</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('genre.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Genre Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="style" class="form-label">Style</label>
                            <select class="form-select" id="style" name="style">
                                <option value="primary">Primary</option>
                                <option value="secondary">Secondary</option>
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                                <option value="warning">Warning</option>
                                <option value="info">Info</option>
                                <option value="light">Light</option>
                                <option value="dark">Dark</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Create Genre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
