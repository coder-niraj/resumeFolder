<?php

namespace Modules\Admin\DTOs;

use Modules\Admin\Models\Admin;

class AdminDTO
{
    public string $id;
    public string $first_name;
    public string $last_name;
    public string $email;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->first_name = $data['firstname'] ?? '';
        $this->last_name = $data['lastname'] ?? '';
        $this->email = $data['email'] ?? '';
    }
    public static function fromModel(Admin $admin)
    {
    return new self(
        [
            "id"=>$admin->id,
            "firstname"=>  $admin->firstname,
            "lastname"=>  $admin->lastname,
            "email"=>$admin->email,
        ] );
    }
}
