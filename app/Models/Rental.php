<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'books_id',
        'status', // 'status' can be 'Pending Review', 'Approved', 'Returned', 'Overdue', 'Cancelled
        'rental_requested_at',
        'rental_start_at', // 'rental_start_at' is the timestamp when the book rental is approved by a librarian or admin
        'rental_due_at',
        'returned_at',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Books::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
