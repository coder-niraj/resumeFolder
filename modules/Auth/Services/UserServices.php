<?php
namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\DTOs\User\UserLoginDTO;
use Modules\Auth\DTOs\User\UserRegisterDTO;
use Modules\Users\Repositories\UserEloquent;

class UserServices{
    function registerService(UserRegisterDTO $userDTO){
    $userRepo = new UserEloquent();
     if ($userDTO->avatar) {
        $avatarPath = $userDTO->avatar->store(
            'avatars',
            'public'  
        );
    }
    return $userRepo->addUser([
        "firstname"=> $userDTO->firstname,
        "lastname" => $userDTO->lastname,
        "email"    => $userDTO->email,
        "password" => Hash::make($userDTO->password),
        "avatar"   => $avatarPath ?? null,
        "phone"    => $userDTO->phone ?? null,
    ]);
    }
    function loginService(UserLoginDTO $userDTO){
       
        if(Auth::guard("web")->attempt([
            "email"    => $userDTO->email,
            "password" => $userDTO->password,
            ])){
                request()->session()->regenerate();
                return true;
            }else{
            return false;

        }

    }
}