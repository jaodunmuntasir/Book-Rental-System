@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __("403 Forbidden. You can't access this page. Please go back to the dashboard.") }}
            </div>
        </div>
    </div>
</div>

@endsection