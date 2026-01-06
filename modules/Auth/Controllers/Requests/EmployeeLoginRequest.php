<?php

namespace Modules\Auth\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or policy
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }
}
