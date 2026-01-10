<?php

namespace Modules\Users\Repositories;

interface UserRepository
{
    function getUser($email);
    function updateUser($email, $data);
    function addUser(array $data);
}
