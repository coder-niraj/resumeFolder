<?php

namespace Modules\Admin\DTOs;

use Modules\Admin\Models\Admin;


class AdminLoginDTO
{
    public string $email;
    public string $password;

    public function __construct(array $data)
    {
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }
}
