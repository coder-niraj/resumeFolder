<?php

namespace Modules\Users\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or policy
    }

    public function rules(): array
    {

        return [
            'email' => 'required|email',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'nullable|min:8',
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
