<?php

namespace Modules\Employers\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or policy
    }

    public function rules(): array
    {

        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'company_name' => 'required',
            'company_website' => 'required',
            'phone' => 'nullable|min:8',
            'address' => 'required',
            'status' => 'nullable|boolean',
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
