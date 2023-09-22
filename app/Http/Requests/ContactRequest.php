<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email'],
            'message' => ['required', 'max:500'],
            'terms' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'terms.required' => 'You must agree to the terms and conditions',
        ];
    }
}
