<?php

namespace Modules\Auth\DTOs\Employee;

use Illuminate\Http\UploadedFile;

class EmployeeRegisterDTO
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public string $email,
        public string $password,
        public string $company_name,
        public string $company_website,
        public ?string $phone = null,
        public ?string $address,
        public ?string $status,
        public ?UploadedFile $avatar = null,
    ) {}
}
