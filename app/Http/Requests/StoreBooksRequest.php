<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBooksRequest extends FormRequest
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
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
            'release_date' => 'required|date',
            'pages' => 'required|integer',
            'isbn' => 'required|alpha_num',
            'genre' => 'required|max:255',
            'in_stock' => 'required|integer',
            'cover' => 'required|url',
            'language' => 'required|max:255',
        ];
    }
}
