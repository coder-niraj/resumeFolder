<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Models\Admin;
use Modules\Employers\Models\Employees;
use Modules\Users\Models\User;

class AdminEloquent implements AdminRepository
{
    function changePassword($email, $old, $new)
    {
        $admin = Admin::where('email', $email)->update([
            "password" => Hash::make($new)
        ]);
        return $admin;
    }
    function updateAdmin($email, $data)
    {
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });

        $admin = Admin::where('email', $email)->update($data);
        return $admin;
    }
    function getAdmin($email)
    {
        $admin = Admin::where('email', $email)->first();
        return $admin;
    }
    function getUsers()
    {
        $query = User::select([
            'id',
            'firstname',
            'lastname',
            'email',
            'phone',
            'blocked',
            'created_at'
        ]);
        return $query;
    }
    function getUser($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
    function getEmployee($email)
    {
        $employees = Employees::where('email', $email)->first();
        return $employees;
    }
    function toggleEmployee($email)
    {
        $employees = Employees::where('email', $email)->first();
        $employees->status = !$employees->status;
        $employees->save();
        return true;
        return $employees;
    }
    function toggleUser($email)
    {
        $user = User::where('email', $email)->first();
        $user->blocked = !$user->blocked;
        $user->save();
        return true;
    }
    function getEmployees()
    {
        $query = Employees::select([
            'id',
            'firstname',
            'lastname',
            'email',
            'company_name',
            'company_website',
            'phone',
            'status',
            'created_at'
        ]);
        return $query;
    }
}
