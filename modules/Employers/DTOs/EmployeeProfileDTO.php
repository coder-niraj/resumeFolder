<?php

namespace Modules\Employers\DTOs;

use Illuminate\Http\UploadedFile;
use Modules\Admin\Models\Admin;

class EmployeeProfileDTO
{

    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $address,
        public string $company_name,
        public string $company_website,
        public ?string $phone = null,
        public ?UploadedFile $avatar = null,
    ) {}
}
