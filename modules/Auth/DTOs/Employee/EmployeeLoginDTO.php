<?php

namespace Modules\Auth\DTOs\Employee;

class EmployeeLoginDTO
{
    public string $email;
    public string $password;
    function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
