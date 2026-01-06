<?php

namespace Modules\Admin\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
