<?php

namespace Modules\Users\DTOs;

use Illuminate\Http\UploadedFile;

class UserProfileDTO
{
    public function __construct(
        public string $email,
        public string $first_name,
        public string $last_name,
        public ?string $phone = null,
        public ?UploadedFile $avatar = null,
    ) {}
}
