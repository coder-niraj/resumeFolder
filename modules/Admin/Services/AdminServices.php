<?php
namespace Modules\Admin\Services;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\DTOs\AdminDTO;
use Modules\Admin\DTOs\AdminLoginDTO;
use Modules\Admin\Models\Admin;

class AdminServices{
    function AdminLogin(AdminLoginDTO $adminDTO){
            return Auth::guard("admin")->attempt([
            "email"=>$adminDTO->email,
            "password"=>$adminDTO->password,
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
}