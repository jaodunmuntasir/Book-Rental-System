@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>Genres List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
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
                                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                                        <!-- {{ route('genre.edit', $genre->id) }} -->
                                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                                            <!-- onclick="return confirm('Are you sure?')" -->
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

@endsection