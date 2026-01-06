<?php

namespace Modules\Employers\Services;

use Modules\Employers\DTOs\EmployeeProfileDTO;
use Modules\Employers\Repositories\EmployeeEloquent;

class EmployeeServices
{

    function updateEmployeeProfile(EmployeeProfileDTO $employeeDTO, $email)
    {
        if ($employeeDTO->avatar) {
            $avatarPath = $employeeDTO->avatar->store(
                'avatars',
                'public'
            );
        }

        $employeeRepo = new EmployeeEloquent();
        $employeeRepo->update($email, [
            'firstname' => $employeeDTO->first_name,
            'lastname' => $employeeDTO->last_name,
            'phone' => $employeeDTO->phone,
            'avatar' => $avatarPath ?? null,
            'address' => $employeeDTO->address,
            'company_name' => $employeeDTO->company_name,
            'company_website' => $employeeDTO->company_website,
        ]);
    }
    function profile() {}
    function changePassword($email, $password)
    {
        $employeeRepo = new EmployeeEloquent();
        $employeeRepo->changePassword($email, $password);
    }
}
