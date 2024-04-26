<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class UpdateRentalRequest extends FormRequest
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
            'status' => ['required', 'string', 'in:Pending Review,Approved,Returned,Overdue,Cancelled'],
            'rental_start_at' => ['nullable', 'date_format:Y-m-d\TH:i'], // Make sure the format matches the input
            'rental_due_at' => ['nullable', 'date_format:Y-m-d\TH:i'], // Make sure the format matches the input
            'returned_at' => ['nullable', 'date_format:Y-m-d\TH:i'], // Make sure the format matches the input
        ];
    }

}
