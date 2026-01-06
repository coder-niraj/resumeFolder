<?php

namespace Modules\Admin\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Admin\DTOs\AdminDTO;
use Modules\Admin\DTOs\AdminLoginDTO;
use Modules\Admin\DTOs\AdminUpdateDTO;
use Modules\Admin\Models\Admin;
use Modules\Admin\Repositories\AdminEloquent;

class AdminServices
{
    function AdminLogin(AdminLoginDTO $adminDTO)
    {
        return Auth::guard("admin")->attempt([
            "email" => $adminDTO->email,
            "password" => $adminDTO->password,
        ]);
    }
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        if (! $admin instanceof Admin) {
            return null;
        }
        return AdminDTO::fromModel($admin);
    }
    public function updateAdminProfile(AdminUpdateDTO $adminDTO, $email)
    {
        if ($adminDTO->avatar) {
            $avatarPath = $adminDTO->avatar->store(
                'avatars',
                'public'
            );
        }
        $adminRepo = new AdminEloquent();
        return $adminRepo->updateAdmin($email, [
            'firstname' => $adminDTO->first_name,
            'lastname' => $adminDTO->last_name,
            'avatar' => $avatarPath ?? NULL,

        ]);
    }
    public function changePassword($email, $old, $new)
    {
        $adminRepo = new AdminEloquent();
        return $adminRepo->changePassword($email, $old, $new);
    }
    public function getUsersService()
    {
        $adminRepo = new AdminEloquent();
        return $adminRepo->getUsers();
    }
    public function getEmployeesService()
    {
        $adminRepo = new AdminEloquent();
        return $adminRepo->getEmployees();
    }
    public function getEmployeeService($email)
    {
        $adminRepo = new AdminEloquent();
        return $adminRepo->getEmployee($email);
    }
    public function getEmployeeToggleService($email)
    {
        $adminRepo = new AdminEloquent();
        return $adminRepo->toggleEmployee($email);
    }
    public function getUserService($email)
    {
        $adminRepo = new AdminEloquent();
        return $adminRepo->toggleUser($email);
    }
    public function getUserToggleService($email)
    {
        $adminRepo = new AdminEloquent();
        return $adminRepo->toggleUser($email);
    }
}
