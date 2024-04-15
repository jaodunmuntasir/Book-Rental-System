<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

Route::get('/', function () {
    return view('home');
});

Route::resource("books", BooksController::class);
