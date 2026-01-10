<?php

namespace Modules\Jobs\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class JobPostUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or policy
    }

    public function rules(): array
    {
        return [
            'id' => 'uuid|required|exists:job_postings,id',
            'employer_id' => 'uuid|required|exists:employees,id',
            'title' => 'string|required',
            'description' => 'string|required',
            'skills' => 'array|required',
            'experience' => 'string',
            'location_id' => 'uuid|required|exists:job_locations,id',
            'work_type' => 'required|in:remote,on-site,hybrid',
            'active' => 'boolean',
            // 'applications_count' => '',
            'job_type' => 'required|in:full-time,part-time,contract,internship,temporary',
            'job_time' => 'required|in:day,night,flexible',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'education' => 'nullable|string',
            'ending_date' => 'nullable|date|after_or_equal:today',
            // 'posted_at' => 'nullable|date',
        ];
    }
}
