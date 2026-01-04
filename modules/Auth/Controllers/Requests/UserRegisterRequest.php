<?php

namespace Modules\Auth\Controllers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'phone' => 'nullable|min:8',
        ];
    }
}