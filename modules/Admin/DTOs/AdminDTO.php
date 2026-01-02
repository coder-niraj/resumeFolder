<?php

namespace Modules\Admin\DTOs;

class AdminDTO
{
    public string $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->first_name = $data['firstname'] ?? '';
        $this->last_name = $data['lastname'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }
}
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
