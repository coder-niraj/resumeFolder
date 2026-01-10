<?php

namespace Modules\Jobs\Services;

use Modules\Jobs\DTOs\AddJobPostDTO;
use Modules\Jobs\DTOs\UpdateJobDTO;
use Modules\Jobs\Repositories\JobPostEloquent;

class JobPostService
{
    private $jobRepo;
    public function __construct(JobPostEloquent $repo)
    {
        $this->jobRepo = $repo;
    }
    function getJobSkills()
    {

        return $this->jobRepo->getJobSkills();
    }
    function getJob($id)
    {
        return $this->jobRepo->getJobPost($id);
    }
    function deleteJob($id)
    {
        return $this->jobRepo->deleteJobPost($id);
    }
    function toggleActiveJob($id)
    {
        $this->jobRepo->toggleJobActivePost($id);
    }
    function getJobs($id)
    {
        return $this->jobRepo->getJobs($id);
    }
    function getApplications($id, $jobId)
    {
        return $this->jobRepo->getApplications($id, $jobId);
    }
    function changeApplicationStatus($id, $status)
    {
        return $this->jobRepo->changeApplicationStatus($id, $status);
    }
    function getApplication($id)
    {

        return $this->jobRepo->getApplication($id);
    }
    function addJobPost(AddJobPostDTO $jobpostGTO)
    {

        $this->jobRepo->createJobPost([
            'employer_id' => $jobpostGTO->employer_id,
            'location_id' => $jobpostGTO->location_id,
            'title' => $jobpostGTO->title,
            'description' => $jobpostGTO->description,
            'skills' => $jobpostGTO->skills,
            'experience' => $jobpostGTO->experience,
            'job_type' => $jobpostGTO->job_type,
            'job_time' => $jobpostGTO->job_time,
            'work_type' => $jobpostGTO->work_type,
            'salary_min' => $jobpostGTO->salary_min ?? null,
            'salary_max' => $jobpostGTO->salary_max ?? null,
            'education' => $jobpostGTO->education ?? null,
            'ending_date' => $jobpostGTO->ending_date ?? null,
        ]);
    }
    function updateJobPost(UpdateJobDTO $jobpostGTO, $id)
    {

        $this->jobRepo->updateJobPost($id, [
            'employer_id' => $jobpostGTO->employer_id,
            'location_id' => $jobpostGTO->location_id,
            'title' => $jobpostGTO->title,
            'description' => $jobpostGTO->description,
            'skills' => $jobpostGTO->skills,
            'experience' => $jobpostGTO->experience,
            'job_type' => $jobpostGTO->job_type,
            'job_time' => $jobpostGTO->job_time,
            'work_type' => $jobpostGTO->work_type,
            'salary_min' => $jobpostGTO->salary_min ?? null,
            'salary_max' => $jobpostGTO->salary_max ?? null,
            'education' => $jobpostGTO->education ?? null,
            'ending_date' => $jobpostGTO->ending_date ?? null,
        ]);
    }
}
