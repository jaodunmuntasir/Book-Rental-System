@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="container py-5">
    <div class="row g-4">
        <!-- Number of Readers Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Number of Readers</div>
                            <div class="text-lg fw-bold">{{ $numberOfReaders }}</div>
                        </div>
                        <i class="fas fa-users fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Number of Genres Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-dark-75 small">Number of Genres</div>
                            <div class="text-lg fw-bold">{{ $numberOfGenres }}</div>
                        </div>
                        <i class="fas fa-bookmark fa-2x text-dark-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Number of Books Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Number of Books</div>
                            <div class="text-lg fw-bold">{{ $numberOfBooks }}</div>
                        </div>
                        <i class="fas fa-book fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Number of Active Book Rentals Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Active Book Rentals</div>
                            <div class="text-lg fw-bold">{{ $numberOfActiveRentals }}</div>
                        </div>
                        <i class="fas fa-book-reader fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Most Popular Book Card -->
        <div class="col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Most Popular Book</h5>
                    <div class="d-flex align-items-center">
                        <img src="{{ $popularBookCover }}" alt="cover" class="img-fluid rounded me-4" style="width: 100px; height: auto;">
                        <div>
                            <div class="text-muted small">Title: {{ $popularBookTitle }}</div>
                            <div class="text-muted small">Author: {{ $popularBookAuthor }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
