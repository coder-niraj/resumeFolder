<?php

namespace Modules\Applications\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or policy
    }

    public function rules(): array
    {

        return [
            'user_id' => 'uuid|required|exists:users,id',
            'job_posting_id' => 'uuid|required|exists:job_postings,id',
            'cover_letter' => 'required',
            'expected_ctc' => 'required',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ];
    }
}
