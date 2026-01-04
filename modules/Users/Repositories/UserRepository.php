<?php
namespace Modules\Users\Repositories;
interface UserRepository{
    function getUser($email);
    function updateUser($data,$column,$value);
    function addUser(array $data);
} 