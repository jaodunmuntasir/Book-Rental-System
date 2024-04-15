<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'release_date',
        'pages',
        'isbn',
        'description',
        'genres',
        'in_stock',
    ];
}