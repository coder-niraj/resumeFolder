<?php

namespace Modules\Admin\Repositories;

interface AdminRepository
{
    function getAdmin($email);
    function updateAdmin($email, $data);
    function getUsers();
    function getUser($email);
    function getEmployees();
    function getEmployee($email);
    function toggleEmployee($email);
    function toggleUser($email);
    function changePassword($email, $old, $new);
}
