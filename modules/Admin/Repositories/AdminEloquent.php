<?php
namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\Auth;
use Modules\Admin\Models\Admin;

class AdminEloquent implements AdminRepository{
    function getAdmin($email){
        $admin = Admin::where('email',$email)->first();
        return $admin;
    }
}