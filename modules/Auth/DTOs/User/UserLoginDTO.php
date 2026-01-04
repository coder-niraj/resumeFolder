<?php

namespace Modules\Auth\DTOs\User;

class UserLoginDTO{

    public string $email;
    public string $password;
    function __construct($email,$password){
        $this->email = $email;
        $this->password = $password;
    }
    
}