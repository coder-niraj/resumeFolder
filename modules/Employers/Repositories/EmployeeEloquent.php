<?php

namespace Modules\Employers\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\Employers\Models\Employees;

class EmployeeEloquent implements EmployeeRepository
{
    function find($email)
    {
        return Employees::where("email", $email)->first();
    }
    function create(array $data)
    {
        return Employees::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'company_name'  => $data['company_name'],
            'company_website'  => $data['company_website'],
            'address'  => $data['address'],
            'status'  => false,
            'phone'     => $data['phone'] ?? null,
            'avatar'    => $data['avatar'] ?? null,
        ]);
    }
    function changePassword($email, $password)
    {
        $employeeObj = Employees::where('email', $email)->update([
            "password" => Hash::make($password)
        ]);
        return $employeeObj;
    }
    function update($email, $data)
    {

        $allowed = ['firstname', 'lastname', 'phone', 'avatar', 'address', 'company_name', 'company_website'];
        $updateData = [];

        foreach ($allowed as $field) {
            if (array_key_exists($field, $data)) {
                $updateData[$field] = $data[$field];
            }
        }
        $updateData = array_filter($updateData, function ($value) {
            return !is_null($value) && $value !== '';
        });
        return Employees::where('email', $email)->update($updateData);
    }
}
