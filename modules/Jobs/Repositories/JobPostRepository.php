<?php

namespace Modules\Jobs\Repositories;

interface JobPostRepository
{
    function createJobPost($data);
    function updateJobPost($id, $data);
    function deleteJobPost($id);
    function getJobPost($id);
    function getJobSkills();
}
