<?php

namespace Modules\Jobs\Repositories;

use Modules\Applications\Models\JobApplications;
use Modules\Jobs\Models\JobSkill;
use Modules\Jobs\Models\Jobs;

class JobPostEloquent implements JobPostRepository
{
    function createJobPost($data)
    {
        return Jobs::create($data);
    }
    function updateJobPost($id, $data)
    {
        // dd($id);
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });
        return Jobs::where('id', $id)->update($data);
    }
    function deleteJobPost($id)
    {
        return Jobs::where('id', $id)->delete();
    }
    function toggleJobActivePost($id)
    {
        $jobPost = Jobs::where('id', $id)->first();
        $jobPost->active = !$jobPost->active;
        $jobPost->save();
    }
    function getJobPost($id)
    {
        return Jobs::where('id', $id)->first();
    }
    function getJobSkills()
    {
        return JobSkill::all();
    }
    function getJobs($id)
    {
        $query = Jobs::select([
            'id',
            'title',
            'description',
            'experience',
            'job_type',
            'ending_date',
            'active',
        ])->where('employer_id', $id)->get();

        return $query;
    }
    function getApplications($id, $jobId)
    {
        $query = JobApplications::with(['user', 'job', 'resume'])
            ->where('job_posting_id', $jobId)->get();
        return $query;
    }
    function getApplication($id)
    {
        $query = JobApplications::where('id', $id)->first();
        return $query;
    }
    function changeApplicationStatus($id, $status)
    {
        $query = JobApplications::where('id', $id)->update([
            'status' => $status
        ]);
        return $query;
    }
}
