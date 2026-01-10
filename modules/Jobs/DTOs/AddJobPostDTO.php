<?php

namespace Modules\Jobs\DTOs;


class AddJobPostDTO
{
    function __construct(
        public string $employer_id,
        public string $location_id,
        public string $title,
        public string $description,
        public array $skills,
        public string $experience,
        public string $job_type,
        public string $job_time,
        public string $work_type,
        public ?int $salary_min = null,
        public ?int $salary_max = null,
        public ?string $education = null,
        public $ending_date = null,
    ) {}
}
