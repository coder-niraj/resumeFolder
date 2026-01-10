<?php

namespace Modules\Applications\DTOs;

use Illuminate\Http\UploadedFile;

class CreateApplicationDTO
{
    public function __construct(
        public string $user_id,
        public string $job_posting_id,
        public string $cover_letter,
        public string $expected_ctc,
        public ?UploadedFile $resume = null,

    ) {}
}
