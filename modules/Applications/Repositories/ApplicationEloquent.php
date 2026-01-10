<?php

namespace Modules\Applications\Repositories;

use Illuminate\Support\Carbon;
use Modules\Applications\Models\JobApplications;

class ApplicationEloquent implements ApplicatonRepository
{
    function createApplication($data)
    {
        dd($data);
    }
    function getApplicationLists($id)
    {
        $query = JobApplications::with(['user', 'job', 'resume'])
            ->where('user_id', $id)->get();
        return $query;
    }
    function createApplicationDemo($data, $id)
    {
        $exists = JobApplications::where('user_id', $id)
            ->where('job_posting_id', $data['job_posting_id'])
            ->exists();
        if ($exists) {
            return null;
        } else {
            $application = JobApplications::create([
                'user_id' => $id,
                'job_posting_id' => $data['job_posting_id'],
                'expected_ctc' => $data['expected_ctc'],
                'cover_letter' => $data['cover_letter'],
                'applied_at' => Carbon::now(),
            ]);
            return $application;
        }
    }
    function updateApplicationResume($application, $resume)
    {
        $application->update([
            'resume_id' => $resume->id
        ]);
    }
    function removeApplication()
    {
        throw new \Exception('Not implemented');
    }
    function UpdateApplication()
    {
        throw new \Exception('Not implemented');
    }
}
