<?php

namespace Modules\Admin\DTOs;

use Illuminate\Http\UploadedFile;
use Modules\Admin\Models\Admin;

class AdminUpdateDTO
{

    public function __construct(
        public string $first_name,
        public string $last_name,
        public ?UploadedFile $avatar = null,
    ) {}
}
