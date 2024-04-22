<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'books_id' => ['required', 'exists:books,id'],
            'rental_requested_at' => ['required', 'date'],
            'rental_start_at' => ['nullable', 'date'],
            'rental_due_at' => ['nullable', 'date'],
            'returned_at' => ['nullable', 'date'],
            'status' => ['required', 'string', 'in:Pending Review,Approved,Returned,Overdue,Cancelled'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
