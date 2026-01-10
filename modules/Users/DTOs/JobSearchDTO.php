<?php

namespace Modules\Users\DTOs;

use Illuminate\Http\UploadedFile;

class JobSearchDTO
{
    public function __construct(
        public ?string $job_type = null,
        public ?string $job_time = null,
        public ?string $work_type = null,
        public ?string $search = null,
    ) {}
}
