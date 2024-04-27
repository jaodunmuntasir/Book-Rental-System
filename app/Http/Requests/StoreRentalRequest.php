<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StoreRentalRequest extends FormRequest
{
    // Prepare the data for validation.
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::id(),
            'books_id' => $this->route('book')->id,
            'status' => 'Pending Review',
            'rental_requested_at' => now(),
        ]);
    }
    
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
            'user_id' => ['required', 'exists:users,id'],
            'books_id' => ['required', 'exists:books,id'],
            'status' => ['required', 'string', 'in:Pending Review,Approved,Returned,Overdue,Cancelled'],
            'rental_requested_at' => ['required'],
            'rental_start_at' => ['nullable', 'date'],
            'rental_due_at' => ['nullable', 'date'],
            'returned_at' => ['nullable', 'date'],
        ];
    }
}
