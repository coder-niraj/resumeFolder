<?php

namespace Modules\Auth\DTOs\User;

use Illuminate\Http\UploadedFile;

class UserRegisterDTO{



   public function __construct(
        public string $firstname,
        public string $lastname,
        public string $email,
        public string $password,
        public ?string $phone = null,
        public ?UploadedFile $avatar = null,
    ) {}  

}
