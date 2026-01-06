<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\DTOs\Employee\EmployeeLoginDTO;
use Modules\Auth\DTOs\Employee\EmployeeRegisterDTO;
use Modules\Employers\DTOs\EmployeeProfileDTO;
use Modules\Employers\Repositories\EmployeeEloquent;

class EmployeeService
{
    function loginService(EmployeeLoginDTO $employeeDTO)
    {
        if (Auth::guard("employee")->attempt([
            "email"    => $employeeDTO->email,
            "password" => $employeeDTO->password,
        ])) {
            request()->session()->regenerate();
            return true;
        } else {
            return false;
        }
    }
    function registerService(EmployeeRegisterDTO $employeeDTO)
    {
        $employeRepo = new EmployeeEloquent();
        if ($employeeDTO->avatar) {
            $avatarPath = $employeeDTO->avatar->store(
                'avatars',
                'public'
            );
        }
        return $employeRepo->create([
            "firstname" => $employeeDTO->firstname,
            "lastname" => $employeeDTO->lastname,
            "email"    => $employeeDTO->email,
            "password" => Hash::make($employeeDTO->password),
            "company_name"  => $employeeDTO->company_name,
            "company_website"  => $employeeDTO->company_website,
            "address"  => $employeeDTO->address,
            "status"  => $employeeDTO->status,
            "avatar"   => $avatarPath ?? null,
            "phone"    => $employeeDTO->phone ?? null,
        ]);
    }
    // function updateService(EmployeeProfileDTO $employeeDTO) {}
}
